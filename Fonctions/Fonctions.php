<?php 
    
    //Affiche le menu. Si l'utilisateur est connecter il pourra naviguer sinon nan.
    //$estConnecter est un boolean.
    function menu($Index = false) {
        if(!$Index) {
            echo "<header>
                <nav>
                    <ul>
                        <li><a href=\"./../index.php\">Connexion</a></li>
                        <li><a href=\"./Statistiques.php\">Statistiques</a></li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./RechercheJoueur.php\">Rechercher un joueur</a></li>
                            <li><a href=\"./AjoutJoueur.php\">Ajouter un joueur</a></li>
                            <li><a href=\"./AfficherJoueurs.php\">Liste des joueurs</a></li>
                        </ul>
                        </li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Matchs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./RechercherMatch.php\">Rechercher un match</a></li>
                            <li><a href=\"./AjouterUnAdversaire.php\">Ajouter un adversaire</a></li>
                            <li><a href=\"./SaisieMatch.php\">Ajouter un match</a></li>
                            <li><a href=\"./ListeMatchs.php\">Liste des Matchs</a></li>
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
                        <li><a href=\"./Pages/Statistiques.php\">Statistiques</a></li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./Pages/RechercheJoueur.php\">Rechercher un joueur</a></li>
                            <li><a href=\"./Pages/AjoutJoueur.php\">Ajouter un joueur</a></li>
                            <li><a href=\"./Pages/AfficherJoueurs.php\">Liste des joueurs</a></li>
                        </ul>
                        </li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Matchs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./Pages/RechercherMatch.php\">Rechercher un match</a></li>
                            <li><a href=\"./Pages/AjouterUnAdversaire.php\">Ajouter un adversaire</a></li>
                            <li><a href=\"./Pages/SaisieMatch.php\">Ajouter un match</a></li>
                            <li><a href=\"./Pages/ListeMatchs.php\">Liste des Matchs</a></li>       
                        </ul>
                        </li>
                    </ul>
                </nav>
            </header>";
        }
        
    }

    function afficherPhotoJoueurs($Joueur) {
        $repertoirePhoto = "../projet-photos/";
        chmod("../projet-photos", 0755);
        echo "<img src=\"".$repertoirePhoto.$Joueur['Photo']."\" style=\"max-width:130px; max-height:150px;\" alt=\"Photo du joueur\">";
    }

    function afficherInformationsJoueurs($Joueur) {
        echo "
            <ul>
                <li>Licence : ".$Joueur['Num_Licence']."</li>
                <li>Nom : ".$Joueur['Nom']."</li>
                <li>Prénom : ".$Joueur['Prenom']." </li>
                <li>Date de naissance : ".$Joueur['Date_naissance']." </li>
                <li>Taille : ".$Joueur['Taille']." </li>
                <li>Poid : ".$Joueur['Poid']." </li>
                <li>Poste préféré : ".$Joueur['Poste_pref']."</li>
                <li>Note : ".$Joueur['note']." </li>
                <li>Statut : ".$Joueur['Statut']."</li>
            </ul>
        ";
    }

    function Bouton($redirection, $label, $joueur){
        $query = http_build_query(array('joueur' => $joueur));
        $redirection .= '?' . $query;
        echo "<button class='modify-button' data-redirection='$redirection'>".$label."</button>";
    }

    //Bloque l'affichage d'une page si l'utilisateur n'est pas connecté
    function blocageConnexion() {
        session_start();
        if (!isset($_SESSION['Connecter']) || !$_SESSION['Connecter']) {
            header("Location: ./nonConnecter.php");
            exit;
        }
    }
    
    function afficherPhotoEtinformations($joueur) {
        #Photo joueur
		echo '<div class="photoJoueur">' ;
			afficherPhotoJoueurs($joueur);
		echo '</div>';

		#Informations joueur
		echo '<div class="rechercheInformationsJoueur">' ;
			afficherInformationsJoueurs($joueur);
		echo '</div>';
    }
    
    function formRechercherUnJoueur($redirection) {
        echo "<fieldset>
			<legend>Rechercher un Joueur</legend>
			<form action=\"".$redirection."\" method='post'>
				<p>Nom <input type='text'  name ='Nom'/></p>
				<p>Prénom <input type='text'' name ='Prenom'/></p>
				<input type='submit' name ='valider' value ='valider'>
                <input type='reset' name = 'reset' value ='Effacer'>
			</form>
		</fieldset>";
    }

?>