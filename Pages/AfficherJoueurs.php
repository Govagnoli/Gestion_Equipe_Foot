<?php 
	session_start();
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctAfficherJoueur.php';
	$linkpdo = connexionBDD();

?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">
	</head>
	<body>
		<?php 
			menu($_SESSION['Connecter']);

			$joueurs = selectAll($linkpdo);

			foreach ($joueurs as $joueur) {
				echo '<div class="rechercheJoueur">' ;

						#Photo joueur
						echo '<div class="photoJoueur">' ;
							afficherPhotoJoueurs($joueur);
						echo '</div>';

						#Informations joueur
						echo '<div class="rechercheInformationsJoueur">' ;
							afficherInformationsJoueurs($joueur);
						echo '</div>';
						
						#Les boutons
						echo '<div class="Boutons">';
							
							#Bouton modifier
							echo '<div class="BoutonsModifier">' ;
								Bouton('./ModifierUnJoueur.php', 'Modifier', $joueur);
							echo '</div>';

							#Bouton supprimer
							echo '<div class="BoutonsSupprimer">' ;
								BoutonSupprimer($linkpdo, $joueur, 'Supprimer');
							echo '</div>';
						echo '</div>';
					
					echo '</div>';
			}
		?>



	</body>
</html>