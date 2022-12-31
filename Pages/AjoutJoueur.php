<?php 
	session_start();
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctAjoutJoueur.php';
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
			formulaireAjoutJoueur();
			if (!empty($_POST['Licence'])) {
				
			}

		?>
	</body>
</html>