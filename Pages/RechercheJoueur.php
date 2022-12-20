<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">s
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
		<div class="FormulaireRecherJoueur">
			<fieldset>
			<legend>Rechercher Joueur par son nom et prénom</legend>
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