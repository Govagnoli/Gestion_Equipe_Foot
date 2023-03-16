<?php
    include './../Fonctions/Fonctions.php';
    blocageConnexion();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include './../Fonctions/FctModifierMatch.php';
    include './../Fonctions/Requetes.php';
    
    $linkpdo = connexionBDD();

	if(!empty($_GET['joueur'])) {
		$Match = $_GET['joueur'];
	}    
    if(!empty($_POST['Id_Matchs'])) {
        $Match = array('Id_Matchs', 'Date_M', 'Lieu_rencontre', 'Heure', 'Score_adverse', 'Score_equipe', 'Id_Adversaire');

        //Créer un tableau associatif du Match avec la valeur du champ du formulaire correspondant. Si le champ est vide la valeur est mise à null.
        foreach($Match as $colonne) {
            switch(empty($colonne)) {
                case true :
                    $Match[$colonne] = null;
                    break;
                case false :
                    $Match[$colonne] =  $_POST[$colonne];
                    break;
            }
        }
    }
    
    $joueurs = selectAllJoueursActif($linkpdo);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Matchs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title>Modifier un match</title>
	</head>
	<body>
		<?php 
		    menu();  
		    $nomAdversaire = SelectNomAdversaire($linkpdo, $Match['Id_Adversaire']);
		    echo '<div class="ContainerModifierMatch">';
    			echo '<div class="rechercheJoueur">' ;				
    				#Affiche un formulaire pour modifier les informations du match
    				echo "<div class='AfficherJoueur'>" ;
    					formulaireModifierMatch($Match, $nomAdversaire);
    				echo '</div>';
    			echo '</div>';
    			
    			Bouton('./ModifierMatchJoueur.php', 'Modifier les Joueurs du match', $Match);
    			
			
            
            if(!empty($_POST['Id_Matchs'])) {
                $Libelle_param = array('Id_Matchs', 'Date_M', 'Lieu_rencontre', 'Heure', 'Score_adverse', 'Score_equipe', 'Id_Adversaire');
                $codeErreur = 0;
                $linkpdo->beginTransaction();
                $linkpdo->exec("SAVEPOINT Avant_ModificationMacth");
                foreach($Libelle_param as $colonne) {
                    $codeErreur = UpdateTableAvecId($linkpdo, 'matchs', $Match, $colonne);
                    if($codeErreur!=0) {
                        $linkpdo->exec("ROLLBACK TO SAVEPOINT Avant_ModificationMacth");
                        echo "Une erreur est survenue, Veuillez recommencer";
                        break;
                    }
                }
                $linkpdo->commit();
            }
		?>
		<script>
			document.querySelectorAll('.modify-button').forEach(button => {
				button.addEventListener('click', () => {
					window.location.href = button.dataset.redirection;
				});
			});
		</script>
	</body>
</html>















