<?php
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctListeMatchs.php';
	include './../Fonctions/Requetes.php';
	$linkpdo = connexionBDD();

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
            $matches = selectAllMatchs($linkpdo);
            foreach ($matches as $match) {
                
				echo '<div class="rechercheJoueur">' ;
					#Informations Matchs
					echo '<div class="rechercheInformationsJoueur">' ;
						echo "
                            <fieldset> 
                				<legend>Match numéros : ".$match['Id_Matchs']."</legend>
                				<p> ID match : ".$match['Id_Matchs']." </p>
                				<p> Date du match : ".$match['Date_M']."</p>
                				<p> Lieux de la rencontre : ".$match['Lieu_rencontre']."</p>
                				<p> Heure du match : ".$match['Heure']."</p>
                				<p> Score de l'équipe adverse : ".$match['Score_adverse']."</p>
                				<p> Score de l'équipe : ".$match['Score_equipe']."</p>
                				<p>ID de l'adversaire : ".$match['Id_Adversaire']."</p>
                			</fieldset>
                        ";
					echo '</div>';
                        
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
					echo '</div>';
				echo '</div>';
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









