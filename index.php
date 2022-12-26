<?php 
	session_start();
	include './Fonctions/FctIndex.php';

	$erreur = false;

	if(empty($_SESSION['Connecter'])) {
		$_SESSION['Connecter'] = false;
	}

	if(!isset($_COOKIE['login']) && !isset($_COOKIE['pwd'])) {
		if(setcookie('login', null, time() + 600) == 0) {
	        exit('Impossible créer cookie login');
	    }
	    if(setcookie('pwd', null, time() + 600) == 0) {
	        exit('Impossible créer cookie pwd');
	    }
	}

	if(empty($_POST['login']) && empty($_POST['pwd']) && empty($_SESSION['Connecter'])) {
		$_SESSION['Connecter'] = false;
	} else {
		if(!$_SESSION['Connecter']) {
			if(seConnecter($_POST['login'], $_POST['pwd'])) {
				$_SESSION['Connecter'] = true;
				setcookie('login', $_POST['login'], time() + 600);
				setcookie('pwd', $_POST['pwd'], time() + 600);
				$erreur = false;
			} else {
				$erreur = true;
			}
		}
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="CSS/Style.css">
	</head>
	<body>
		<?php 
			if($_SESSION['Connecter']) {
				echo "<header>
					<nav>
					  	<ul>
					  		<li><a href=\"./index.php\">Accueil</a></li>
				    		<li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
				      		<ul class=\"sous\">
						        <li><a href=\"./Pages/RechercheJoueur.php\">Rechercher un joueur</a></li>
						        <li><a href=\"./Pages/AjoutJoueur.php\">Ajouter un joueur</a></li>
					      	</ul>
					    	</li>
					    </ul>
					</nav>
				</header>";
			} else {
				echo "<header>
					<nav>
					  	<ul>
					  		<li><a href=\"./index.php\">Accueil</a></li>
				    		<li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
				      		<ul class=\"sous\">
						        <li><a href=\"./Pages/nonConnecter.php\">Rechercher un joueur</a></li>
						        <li><a href=\"./Pages/nonConnecter.php\">Ajouter un joueur</a></li>
					      	</ul>
					    	</li>
					    </ul>
					</nav>
				</header>";
			}

			if($erreur) {
				echo "Votre mot de passe ou votre login est incorrect.";
			}

			if ($_SESSION['Connecter']) {
				echo "
					<p>
						Vous êtes connecté 
						<br>Vous pouvez acceder aux autres pages. 
					</p>
				";
			} else {
				echo "
					<fieldset class=\"formulaire\">
			            <legend>Connexion</legend>
			            <form action=\"index.php\" method=\"POST\">
			                <p>Nom <input type=\"text\" name=\"login\" value= \"".formAfficherCookie('login')."\" /></p>
			                <p>Mot de passe <input type=\"password\" name=\"pwd\" value= \"".formAfficherCookie('pwd')."\" /></p>
			                <p> <input type=\"submit\" name =\"valider\" value =\"valider\"> </p>    
			            </form>
			        </fieldset>
				";
			}
		?>
		
		
		
	</body>
</html>
<!DOCTYPE HTML>