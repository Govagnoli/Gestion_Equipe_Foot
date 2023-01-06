<?php 
	
	//Vérifie si l'identifiat et le mot de passe rentré dans le formulaire sont corrects. Puis permet au manager de se connecter
	function seConnecter($login, $pwd) {
		if(strtoupper($login) == 'HABIBI' && $pwd == '1234') {
			return true;
		}
		return false;
	}

	function formAfficherCookie($label) {
		if ($_SESSION['Connecter']) {
            return $_COOKIE[$label];
        }
        return '';
	}

	function menu($estConnecter) {
        if($estConnecter) {
            echo "<header>
                <nav>
                    <ul>
                        <li><a href=\"./index.php\">Connexion</a></li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./Pages/RechercheJoueur.php\">Rechercher un joueur</a></li>
                            <li><a href=\"./Pages/AjoutJoueur.php\">Ajouter un joueur</a></li>
                            <li><a href=\"./Pages/AfficherJoueurs.php\">Liste des joueurs</a></li>
                        </ul>
                        </li>
                    </ul>
                </nav>
            </header>";
        } else {
            echo "<header>
                <nav>
                    <ul>
                        <li><a href=\"./index.php\">Connexion</a></li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./Pages/nonConnecter.php\">Rechercher un joueur</a></li>
                            <li><li><a href=\"./Pages/nonConnecter.php\">Liste des joueurs</a></li></li>
                        </ul>
                        </li>
                    </ul>
                </nav>
            </header>";
        }
    }
?>