<?php 
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctRechercherMatch.php';
	include './../Fonctions/Requetes.php';
	$linkpdo = connexionBDD();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Matchs</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">
	</head>
	<body>
		<?php 
			menu(); 
			formulaireRechercheMatch($linkpdo);
            if(!empty( $_POST['adversaire'])){
                $matchs = getMatchInfo($linkpdo, $_POST['adversaire']);
				if(!empty($matchs)) {
				    foreach($matchs as $match){
				        echo "<fieldset> <legend>Id du Matchs : ".$match['Id_Matchs']."</legend>";
					        echo "<p> Date du Matchs :".$match['Date_M']."</p>";
					        echo "<p> Lieux de rencontre du Matchs :".$match['Lieu_rencontre']."</p>";
					        echo "<p> Heure du Matchs :".$match['Heure']."</p>";
					        echo "<p> Score Adverse :".$match['Score_adverse']."</p>";
					        echo "<p> Score de l'équipe :".$match['Score_equipe']."</p>";
					        echo "<p> Id Adversaire :".$match['Id_Adversaire']."</p>";
					        
	        				#Les boutons
	    				    echo '<div class="Boutons">';
	        					#Bouton modifier
	        					echo '<div class="BoutonsModifier">' ;
	        						Bouton('./ModifierUnMatch.php', 'Modifier', $match);
	        					echo '</div>';
	        					#Bouton supprimer
	        					echo '<div class="BoutonsSupprimer">' ;
	        						Bouton('./SupprimerUnMatch.php', 'Supprimer', $match);
	        					echo '</div>';
	        					echo"<div class='BoutonsSupprimer'>";
	        					    Bouton('./Perfomance.php', 'Performance', $match);
	        					echo"</div>";
	        				echo '</div>';
        				echo "</fieldset>";
                        echo"<br>";
				    }
    			} else {
    				echo 'Aucun match correspond à cet identifiant.';
				}
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