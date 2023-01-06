<?php 
	session_start();
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">
	</head>
	<body>
		<?php menu($_SESSION['Connecter']); ?>
		<div class="FormulaireRecherJoueur">
			<fieldset>
				<legend>Rechercher un Joueur</legend>
				<form action="JoueursRecherches.php" method="post">
					<p>Nom <input type="text"  name ="Nom"/></p>
					<p>Prénom <input type="text" name ="Prenom"/></p>
					<input type="submit" name ="valider" value ="valider">
	                <input type="reset" name = "reset" value ="Effacer">
				</form>
			</fieldset>
		</div>
	</body>
</html>