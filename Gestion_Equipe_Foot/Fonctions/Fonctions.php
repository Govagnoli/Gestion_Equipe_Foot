<?php 
    
    //Affiche le menu. Si l'utilisateur est connecter il pourra naviguer sinon nan.
    //$estConnecter est un boolean.
    function menu($estConnecter) {
        if($estConnecter) {
            echo "<header>
                <nav>
                    <ul>
                        <li><a href=\"./../index.php\">Connexion</a></li>
                        <li class=\"deroulant\"><a href=\"#\">Gestion des Joueurs &ensp;</a>
                        <ul class=\"sous\">
                            <li><a href=\"./RechercheJoueur.php\">Rechercher un joueur</a></li>
                            <li><a href=\"./AjoutJoueur.php\">Ajouter un joueur</a></li>
                            <li><a href=\"./AfficherJoueurs.php\">Liste des joueurs</a></li>
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
                            <li><a href=\"./nonConnecter.php\">Rechercher un joueur</a></li>
                            <li><a href=\"./nonConnecter.php\">Ajouter un joueur</a></li>
                            <li><a href=\"./nonConnecter.php\">Liste des joueurs</a></li>
                        </ul>
                        </li>
                    </ul>
                </nav>
            </header>";
        }
    }

    function connexionBDD() {
        $server = 'localhost';
        $login = 'root';
        $mdp = '';
        $db = 'foot_management';

        try {
            return new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    function requeteRecupererJoueur($linkpdo, $Nom, $Prenom) {
        $reqNom = $linkpdo->prepare('
            SELECT *
            FROM Joueur
            where Nom = :Nom
            AND Prenom = :Prenom
        ');

        $reqNom->execute(array(
            'Nom' => $Nom,
            'Prenom' => $Prenom
        ));

        return $reqNom->fetchAll(PDO::FETCH_ASSOC);
    }

    function requeteSelectJoueurAvecId($linkpdo, $Licence) {
        $req = $linkpdo->prepare('
            SELECT *
            FROM Joueur
            where Num_Licence = :Licence
        ');

        $req->execute(array(
            'Licence' => $Licence
        ));

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function afficherPhotoJoueurs($Joueur) {
        $repertoirePhoto = "../projet-photos/";
        chmod("../projet-photos", 0755);
        echo "<img src=\"".$repertoirePhoto.$Joueur['Photo']."\" alt=\"Photo du joueur\">";
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

    function BoutonSupprimer($linkpdo, $Joueur, $label) {
        $linkpdo_str = json_encode($linkpdo);
        $Joueur_str = json_encode($Joueur);
        //echo "<button class='suppr-button' onclick='".supprimerJoueur($linkpdo, $Joueur)."'>".$label."</button>";
    }


    function supprimerJoueur($linkpdo, $Joueur) {
        $stmt = $linkpdo->prepare('CALL supprimerJoueur(:p_param)');
        $stmt->bindParam(':p_param', $Joueur['Num_Licence']);
        $stmt->execute();
    }

    //Renvoie true si la chaine de caractère $valeur est un number compris entre $min et $max sinon renvoie false
    //vérifie si une chaîne de caractères représente un entier compris entre deux valeurs données
    function StringIsANumber($valeur, $min, $max) {
        if (ctype_digit($valeur)) {
            if (filter_var($valeur, FILTER_VALIDATE_INT, array('options' => array('min_range' => $min, 'max_range' => $max))) === false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    //Si le string est une date de format $format alors renvoie true sinon false
    function StringIsADate($valeur, $format) {
        $date = DateTime::createFromFormat($format, $valeur); // Si la date $valeur est format $format, alors renvoie un object de type DateTime, sinon renvoie false
        if(is_a($date, 'DateTime')) {
            return true;
        }
        return false;
    }

    //Bloque l'affichage d'une page si l'utilisateur n'est pas connecté
    function blocageConnexion() {
        if (!isset($_SESSION['Connecter'])) {
            header("Location: ./nonConnecter.php");
            exit;
        }
    }

?>