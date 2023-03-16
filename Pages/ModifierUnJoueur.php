<?php
    include './../Fonctions/Fonctions.php';
    blocageConnexion();
    include './../Fonctions/FctModifierJoueur.php';
    include './../Fonctions/Requetes.php';
    $linkpdo = connexionBDD();

    $joueur;
    $ex_Licence;
	if(!empty($_GET['joueur'])) {
		$joueur = $_GET['joueur'];
	}    
    if(!empty($_POST['ex_Licence'])) {
    	$ex_Licence = $_POST['ex_Licence'];
		$colonnes = array('Num_Licence', 'Nom', 'Prenom', 'Date_naissance', 'Taille', 'Poid', 'Poste_pref', 'note', 'Statut');
    	foreach($colonnes as $colonne){
    		$joueur[$colonne] = $_POST[$colonne];
    	}
    }

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title>Suppression d'un joueur</title>
	</head>
	<body>
		<?php 
		    menu();   
			echo '<div class="rechercheJoueur">' ;				
				#Affiche un formulaire pour modifier les informations d'un joueur
				echo '<div class="FormModifierJoueur">';
					formulaireModifierJoueur($joueur);
				echo '</div>';
			echo '</div>';
			
			if(!empty($_POST['Num_Licence'])) {
				$code = UpdateJoueurAvecId($linkpdo, $joueur, $ex_Licence);
				if($code == 0) {
					echo "l'enregistrement à bien été pris en compte.";
				} else {
					echo "Une erreur est survenue. Veillez remplir tous les champs au bon format.";
				}
			}
		?>
	</body>
</html>