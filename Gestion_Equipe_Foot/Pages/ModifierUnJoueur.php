<?php
	session_start();
    include './../Fonctions/Fonctions.php';
    blocageConnexion();

    include './../Fonctions/FctModifierJoueur.php';
    
    $linkpdo = connexionBDD();

	if(!empty($_GET['joueur'])) {
		$joueur = $_GET['joueur'];
	}    
    if(!empty($_POST['ex_Licence'])) {
    	$ex_Licence = $_POST['ex_Licence'];

    	if(!empty($_POST['Statut'])) {
    		$joueur = array('Num_Licence', 'Nom', 'Prenom', 'Date_naissance', 'Taille', 'Poid', 'Poste_pref', 'note', 'Statut');
    	} else {
    		$joueur = array('Num_Licence', 'Nom', 'Prenom', 'Date_naissance', 'Taille', 'Poid', 'Poste_pref', 'note');
    	}

    	foreach($joueur as $colonne){
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
			menu($_SESSION['Connecter']);  
			
			echo '<div class="rechercheJoueur">' ;				
				#Affiche un formulaire pour modifier les informations d'un joueur
				echo '<div class="FormModifierJoueur">' ;
					formulaireModifierJoueur($joueur);
				echo '</div>';
			echo '</div>';
			
			$Libelle_param = array('Num_Licence', 'Nom', 'Prenom', 'Date_naissance', 'Taille', 'Poid', 'Poste_pref', 'note');
			/*
			#On vérifie sur chaque champs de saisie, si l'utilisateur à apporté des modifications. S'il apporte une modification, non erronée alors on doit modifier la BDD. Sinon on lui affiche un message d'erreur en fonction de l'erreur.
			$Erreurs = 0;
			$linkpdo->beginTransaction();
			if(!empty($_POST['Num_Licence'])) {
				foreach($Libelle_param as $colonne) {
					$Erreurs = ErreursSaisie($linkpdo, $joueur, $colonne, $_POST[$colonne], $ex_Licence);
					if($Erreurs>0) {
						//On rollback au dernier point de sauvegarde. Et on sort de la boucle
			            $linkpdo->rollBack();
			            break;
					}
				}
				AffichageMsgErreur($Erreurs);
			}
			

			//Vérifie s'il n'y a pas d'erreurs sur l'ensemble des champs de saisies modifiés par l'utilisateur.
			if(!empty($_POST['Num_Licence'])) {
				CheckSiErreur($linkpdo, $_POST[$colonne], $Erreurs);
			}
			*/
			if(!empty($_POST['Num_Licence'])) {
				$code = UpdateTableAvecId($linkpdo, 'Joueur', $_POST['Num_Licence'], $_POST['Nom'], $_POST['Prenom'], $_POST['Date_naissance'], $_POST['Taille'], $_POST['Poid'], $_POST['Poste_pref'], $_POST['note'], $_POST['Statut'], $ex_Licence);
				if($code == 0) {
					echo "l'enregistrement à bien été pris en compte.";
				} else {
					echo "Une erreur est survenue. Veillez remplir tous les champs au bon format.";
				}
			}
		?>
	</body>
</html>