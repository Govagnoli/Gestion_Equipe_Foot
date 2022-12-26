<?php
	session_start();
	include './../Fonctions/Fonctions.php';
	$repertoirePhoto = null;
	$linkpdo = null;
	if(!empty($_POST['Nom']) && !empty($_POST['Prenom'])) {
        $linkpdo = connexionBDD();
	}	
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
	</head>
	<body>
		<?php 
			menu($_SESSION['Connecter']); 

			if(!empty($_POST['Nom']) && !empty($_POST['Prenom'])) {
				$data = requeteRecupererJoueur($linkpdo, $_POST['Nom'],$_POST['Prenom']);
				
				#Pour chaque joueur: affiche sa pp, ses informations, et un bouton modifier et supprimer joueur
				foreach ($data as $Joueur) {
					echo '<div class="rechercheJoueur">' ;

						#Photo joueur
						echo '<div class="photoJoueur">' ;
							afficherPhotoJoueurs($Joueur);
						echo '</div>';

						#Informations joueur
						echo '<div class="rechercheInformationsJoueur">' ;
							afficherInformationsJoueurs($Joueur);
						echo '</div>';
						
						#Les boutons
						echo '<div class="Boutons">';
							
							#Bouton modifier
							echo '<div class="BoutonsModifier">' ;
								Bouton('./ModifierUnJoueur.php', 'Modifier', $Joueur);
							echo '</div>';

							#Bouton supprimer
							echo '<div class="BoutonsSupprimer">' ;
								BoutonSupprimer($linkpdo, $Joueur, 'Supprimer');
							echo '</div>';
						echo '</div>'; 
					
					echo '</div>';
				}
			}
		?>
	</body>
</html>