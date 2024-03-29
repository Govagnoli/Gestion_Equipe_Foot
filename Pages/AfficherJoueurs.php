<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/Requetes.php';
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
			menu();

			$joueurs = selectAllJoueurs($linkpdo);

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
							echo '<div class="Boutons">';
								Bouton('./ModifierUnJoueur.php', 'Modifier', $joueur);
							echo '</div>';

							#Bouton supprimer
							echo '<div class="BoutonsSupprimer">' ;
								Bouton('./SupprimerUnJoueur.php', 'Supprimer', $joueur);
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