<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
		<header>
			<nav>
			  	<ul>
			  		<li><a href="./index.php">Accueil</a></li>
		    		<li class="deroulant"><a href="#">Gestion des Joueurs &ensp;</a>
		      		<ul class="sous">
				        <li><a href="./Pages/RechercheJoueur.php">Rechercher un joueur</a></li>
				        <li><a href="./Pages/AjoutJoueur.php">Ajouter un joueur</a></li>
			      	</ul>
			    	</li>
			    </ul>
			</nav>
		</header>
		
		<fieldset class="formulaire">
            <legend>Connexion</legend>
            <form action="index.php" method="POST">
                <p>Login <input type="text" name="login" value=
                    <?php 
                        if (!empty($_COOKIE['login'])) {
                            echo $login;
                        } else {
                            echo "";
                        }
                    ?> 
                /></p>
                <p>Mot de passe <input type="password" name="mdp" value = 
                    <?php 
                        if (!empty($_COOKIE['mdp'])) {
                            echo $mdp;
                        } else {
                            echo "";
                        }
                    ?> 
                /></p>
                <p>
                    <input type="submit" name ="valider" value ="valider">
                </p>    
            </form>
        </fieldset>
		
	</body>
</html><!DOCTYPE HTML>