<?php
    include './../Fonctions/Fonctions.php';
    $linkpdo = connexionBDD();
    session_start();
    if(isset($_GET['Joueur'])) {
    	$_SESSION['joueur'] = $_GET['Joueur'];
    }    
    $joueur = $_SESSION['joueur'];
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title></title>
	</head>
	<body>
		<header>
			<nav>
			  	<ul>
			  		<li><a href="./../index.php">Accueil</a></li>
		    		<li class="deroulant"><a href="#">Gestion des Joueurs &ensp;</a>
		      		<ul class="sous">
				        <li><a href="./RechercheJoueur.php">Rechercher un joueur</a></li>
				        <li><a href="./AjoutJoueur.php">Ajouter un joueur</a></li>
			      	</ul>
			    	</li>
			    </ul>
			</nav>
		</header>
	
		<?php 
			echo '<div class="rechercheJoueur">' ;

				#Affiche la photo joueur
				echo '<div class="photoJoueur">' ;
					afficherPhotoJoueurs($joueur);
				echo '</div>';

				#Affiche les informations joueur
				echo '<div class="rechercheInformationsJoueur">' ;
					afficherInformationsJoueurs($joueur);
				echo '</div>';
				
				#Affiche un formulire pour modifier les informations d'un joueur
				echo '<div class="FormModifierJoueur">' ;
					formulaireModifierJoueur($joueur);
				echo '</div>';
			echo '</div>';

			$label_parametres =array('Num_Licence', 'Nom', 'Prenom', 'Date_naissance', 'Taille', 'Poid', 'Poste_Pref', 'Note', 'Statut');



			#On vérifie sur chaque champs de saisie, si l'utilisateur à apporté des modifications. S'il apporte une modification, non erronée alors on doit modifier la BDD. Sinon on lui affiche un message d'erreur en fonction de l'erreur.
			$Erreurs = 0;
			$linkpdo->beginTransaction();
			foreach($label_parametres as $colonne) {
				if(!empty($_POST[$colonne])) {
					$Erreurs = ErreursSaisie($linkpdo, $joueur, $colonne, $_POST[$colonne]);
					if($Erreurs>0) {
						//On rollback au dernier point de sauvegarde. Et on sort de la boucle
			            $linkpdo->rollBack();
			            break;
					}
					AffichageMsgErreur($Erreurs);
				}
			}

			//Vérifie s'il n'y a pas d'erreurs sur l'ensemble des champs de saisies modifiés par l'utilisateur.
			foreach($label_parametres as $colonne) {
				if(!empty($valeur)) {
					CheckSiErreur($linkpdo, $_POST[$colonne], $Erreurs);
					break;
				} 
			}
		?>
	</body>
</html>