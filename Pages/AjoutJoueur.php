<?php 
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctAjoutJoueur.php';
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
			formulaireAjoutJoueur();
			
			if (!empty($_POST['Num_Licence'])) {

				//Récupère les $_Post dans un tableau associatif.
				$Libelle_param = array('Num_Licence', 'Nom', 'Prenom', 'Photo', 'Date_naissance', 'Taille', 'Poid', 'Poste_pref', 'note', 'Statut');
				$joueur = array();
				foreach($Libelle_param as $colonne) {
					$joueur[$colonne] = $_POST[$colonne]; 
				}
				if(empty($_POST['note'])) {
					$joueur['note'] = null;
				}

				AjoutJoueur($linkpdo, $joueur);
			}	

		?>
	</body>
</html>