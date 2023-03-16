<?php 
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctAjouterUnAdversaire.php';
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
			formulaireAjoutAdversaire();
			if (!empty($_POST['Nom'])) {
                AjoutAdversaire($linkpdo, $_POST['Nom']);
			}	

		?>
	</body>
</html>