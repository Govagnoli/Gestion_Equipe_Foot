<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include './../Fonctions/Fonctions.php';
    include './../Fonctions/Requetes.php';
    blocageConnexion();

    include './../Fonctions/FctModifierMatch.php';
    
    $linkpdo = connexionBDD();
    $Match;
    if(!empty($_GET['joueur'])) {
        $Match = $_GET['joueur'];
    }
    if(!empty($_POST['Match'])) {
        $Match = selectionMatchById($linkpdo, $_POST['Match']);
    }
	
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
		$joueurs = selectAllJoueursActif($linkpdo);
		    menu();
		    $nomAdversaire = SelectNomAdversaire($linkpdo, $Match['Id_Adversaire']);
    		echo '<div class="scrollableContent">';
    		    echo "<form action='ModifierMatchJoueur.php' method='post'>";
    		        echo "<br><label>Sélectionnez votre équipe pour le match contre l'équipe $nomAdversaire.</label><br>";
                        foreach($joueurs as $joueur) {
                            echo "<div class='AfficherJoueur'>";
                                afficherPhotoEtinformations($joueur);
                                
                                #Les boutons
                                echo '<div class="Boutons">';
                                    
                                    #bouton Titulaire                                
                                    echo '<div>';
                                        echo "<p><input type='radio' name=\"".$joueur['Num_Licence']."\" value='Titulaire'> Titulaire</p>";
                                    echo '</div>';
                                    
                                    #bouton Remplaçant  
                                    echo '<div>';
                                        echo "<p><input type='radio' name=\"".$joueur['Num_Licence']."\" value='Remplacant'> Remplaçant</p>";
                                    echo '</div>';
                                    
                                    #Non selectionné
                                    echo '<div>';
                                        echo "<p><input type='radio' name=\"".$joueur['Num_Licence']."\" value='None' checked> Non selectionné</p>";
                                    echo '</div>';
                                echo '</div>';

                            echo '</div>';
                        }
        			echo '</div>';
        			echo "<input type='hidden' name='Match' value=\"".$Match['Id_Matchs']."\">";
        			echo "<input type=\"submit\" name =\"enregistrer2\" value =\"Enregistrer\">";
        			
        		echo '</form>';
			echo '</div>';
            
            //Gestion des joueurs participants au match. Titulaire, remplaçant ou non sélectionnée
            if(!empty($_POST['enregistrer2'])) {
                $joueurs = selectAllJoueursActif($linkpdo);
                foreach($joueurs as $joueur) {
                    $titulaire = $_POST[$joueur['Num_Licence']];
                    if($titulaire == 'Titulaire') {
                        $code = EstJoueurDuMatch($linkpdo, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        if($code == 1) {
                            updateJouerTitulaire($linkpdo, $titulaire, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        } else {
                            ajouterJoueurMatch($linkpdo, $titulaire, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        }
                    } elseif($titulaire == 'Remplacant') {
                        $code = EstJoueurDuMatch($linkpdo, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        if($code == 1) {
                            updateJouerTitulaire($linkpdo, $titulaire, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        } else {
                            ajouterJoueurMatch($linkpdo, $titulaire, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        }
                    } elseif($titulaire == 'None'){
                        $code = EstJoueurDuMatch($linkpdo, $joueur['Num_Licence'], $Match['Id_Matchs']);
                         if($code == 1) {
                            deleteJouerJoueur($linkpdo, $joueur['Num_Licence'], $Match['Id_Matchs']);
                        }
                    } 
                }
                echo "Les mises à jour ont été effectuées.";
            }
		?>
	</body>
</html>