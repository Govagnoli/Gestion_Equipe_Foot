<?php
	$repertoirePhoto = null;
	$linkpdo = null;
    include './../PHP/Fonctions.php';
    $linkpdo = connexionBDD();
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
	
		<p>Page modifier</p>

	</body>
</html>