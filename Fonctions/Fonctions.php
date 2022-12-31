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
        $repertoirePhoto = "../../../projet-photos/";
        chmod("../../../projet-photos", 0755);
        echo "<img src=\"".$repertoirePhoto.$Joueur['Photo']."\" alt=\"Photo du joueur\" height=\"42\" width=\"42\">";
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

    function Bouton($redirection, $label, $Joueur){
        $query = http_build_query(array('Joueur' => $Joueur));
        $redirection .= '?' . $query;
        echo "<button onclick='redirectToPage()'>".$label."</button>";
        echo "<script>
            function redirectToPage() {
                window.location.href = '".$redirection."';
            }
        </script>";
    }


    #Normalement fonctionne, mais www-data de apache doit avoir le privilège nécessaire pour supprimer un joueur
    # La commande nécessaire est : 
    # GRANT ALL PRIVILEGES ON * . * TO 'www-data'@'localhost';
    function BoutonSupprimer($linkpdo, $Joueur, $label){
        $linkpdo_str = json_encode($linkpdo);
        $Joueur_str = json_encode($Joueur);
        echo "<button onclick='supprimerJoueur()'>".$label."</button>";
        echo "<script>
            function supprimerJoueur() {
                try {
                    var linkpdo = JSON.parse('".$linkpdo_str."');
                    var Joueur = JSON.parse('".$Joueur_str."');
                    var suppressionUnJoueur = linkpdo.prepare('
                        CALL supprimerJoueur(:p_param)
                    ');

                    suppressionUnJoueur.bindParam(
                        ':p_param', Joueur['Num_Licence']
                    );

                    suppressionUnJoueur.execute();
                } catch(PDOException e) {
                    die('Erreur : ' . e.getMessage());
                }
            }
        </script>";
    }


    function formulaireModifierJoueur($joueur) {
        echo "<fieldset>
            <legend>Modification du joueur ".$joueur['Nom']."</legend>
            <form action=\"ModifierUnJoueur.php\" method=\"post\">
                <p>Licence <input type=\"number\" name =\"Num_Licence\" step=\"any\" pattern=\"\d{0,10}\"/></p>
                <p>Nom <input type=\"text\"  name =\"Nom\"/></p>
                <p>Prénom <input type=\"text\" name =\"Prenom\"/></p>
                <p>Date de naissance <input type=\"text\"  name =\"Date_naissance\"/></p>
                <p>Taille  <input type=\"text\" name =\"Taille\"/></p>
                <p>Poid  <input type=\"text\" name =\"Poid\"/></p>
                <p>Poste préféré <input type=\"text\"  name =\"Poste_Pref\"/></p>
                <p>Note  <input type=\"text\"  name =\"Note\"/></p>
                <p>Statut  <input type=\"text\" name =\"Statut\"/></p>
                <input type=\"submit\" name =\"enregistrer\" value =\"Enregistrer\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;
    }
    
    /*
    $linkpdo --> Object de type connection
    $joueur --> tableau associatif
    $colonne --> String correspondant à une colonne de la table Joueur
    $nvValeur --> Correspond à la valeur rentré par l'utilisateur dans le formulaire
    */

    function modifierUnJoueur($linkpdo, $joueur, $colonne, $nvValeure) {
        //je vérifie si le type de ma nouvelle valeur correspond à ma colonne
        if(verifierType($colonne, $nvValeure) != 0) {
            return verifierType($colonne, $nvValeure);
        }
        //Je vérifie si ma license n'est pas déjà utilisé
        if($colonne == 'Num_Licence') {
            if(estLicenceExistante($linkpdo, $nvValeure)) {
                return 5;
            }
        }
        //Je met à jour ma table joueur.
        UpdateTableAvecId($linkpdo, 'Joueur', $colonne, $nvValeure, 'Num_Licence', $joueur['Num_Licence']);
        return 0;   
    }

    function verifierType($colonne, $valeur) {
        if($colonne=='Num_Licence') {
            if(!StringIsANumber($valeur, 1111111111, 9999999999)) {
                return 1;
            }
        }
        if($colonne == 'Date_naissance') {
            if(!StringIsADate($valeur, 'y-m-d')) {
                return 2;
            }
        }
        if($colonne=='Poid') {
            if(!StringIsANumber($valeur, 0, 200)) {
                return 3;
            }
        }
        if($colonne=='Taille') {
            if(!StringIsANumber($valeur, 0, 272)) {
                return 4;
            }
        }
        return 0;
    }

    #Vérifie si la licence $NvLicence n'est pas déjà attribuer à un autre joueur. Renvoie true si la licence existe et false sinon.
    function estLicenceExistante($linkpdo, $NvLicence) {
        $requeteSelectionLicence = "
            SELECT count(*)
            FROM JOUEUR
            WHERE Num_Licence = :Licence
        ";
        $requete = $linkpdo->prepare($requeteSelectionLicence);

        $requete->bindValue(':Licence', $NvLicence, PDO::PARAM_STR);

        $requete->execute();

        $nbrLicence = $requete->fetchColumn();

        if($nbrLicence==0) {
            return false;
        }
        return true;
    }


    /*
    $linkpdo --> Object de type connection
    $Table --> Correspond au String du nom de la table à modifier
    $Colonne --> String du nom de la colonne à modifier (de la table $table)
    $nvValeure --> la nouvelle valeur à de la colonne $colonne à modifier
    $id --> l'identifiant de la table $table
    $valeurId --> Valeur de l'identifiant, pour connaitre l'élement unique à modifier

    Met à jour une donnée d'une table avec l'identifiant associé
    */
    function UpdateTableAvecId($linkpdo, $Table, $colonne, $nvValeure, $id, $valeurId) {
        $SQLModifierJoueur = "
        Update ".$Table." 
        SET ".$colonne." = :nvValeure
        where ".$id." = :id
        ";

        $requeteModifierJoueur = $linkpdo->prepare($SQLModifierJoueur);
        $requeteModifierJoueur->bindValue(':nvValeure', $nvValeure, PDO::PARAM_STR);
        $requeteModifierJoueur->bindValue(':id', $valeurId, PDO::PARAM_STR);
        $requeteModifierJoueur->execute();
    }

    //Renvoie true si la chaine de caractère $valeur est un number compris entre $min et $max sinon renvoie false
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
        return DateTime::createFromFormat($format, $valeur);
    }

    //Retourne le code d'erreur du formulaire modifierJoueur
    function ErreursSaisie($linkpdo, $joueur, $colonne, $valeur) {
        $Erreurs = 0;
        switch (modifierUnJoueur($linkpdo, $joueur, $colonne, $valeur)) {
            case 0:
                break;
            case 1:
                $Erreurs = 1;
                break;
            case 2:
                $Erreurs = 2;
                break;
            case 3:
                $Erreurs = 3;
                break;
            case 4:
                $Erreurs = 4;
                break;
            case 5:
                $Erreurs = 5;
                break;
            default:
                $Erreurs = 6;
                break;
        }
        return $Erreurs;
    }

    //Renvoie le msg d'erreur associé au code d'erreur
    function AffichageMsgErreur($Erreurs) {
        switch ($Erreurs) {
            case 1:
                echo "La licence est invalide."; 
                break;
            case 2:
                echo "La date de naissance n'est pas au bon format. Elle doit être YYYY-MM-DD. Exemple : 2022-12-16";
                break;
            case 3:
                echo "Le poid n'est pas au bon format. il doit être un chiffre compris entre 0 et 200.";
                break;
            case 4:
                echo "La taille n'est pas au bon format. elle doit être un chiffre compris entre 0 et 272.";
                break;
            case 5:
                echo "La nouvelle licence est déjà attribuée à un membre de l'équipe. Une licence est unique à chaque joueur de foot."; 
                break;
            default:
                echo "Une erreur est survenue.";
                break;
        }
    }

    //S'il n'y a pas d'erreur. Commit les opérations, et affiche un msg informatif à l'utilisateur.
    function CheckSiErreur($linkpdo, $Erreurs) {
        if($Erreurs==0) {
            $linkpdo->commit();
            echo "l'enregistrement à bien été pris en compte."; 
        }
    }

    //Bloque l'affichage d'une page si l'utilisateur n'est pas connecté
    function blocageConnexion() {
        if (!isset($_SESSION['Connecter'])) {
            header("Location: ./nonConnecter.php");
            exit;
        }
    }

?>