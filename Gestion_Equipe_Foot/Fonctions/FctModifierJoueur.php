<?php

    function formulaireModifierJoueur($joueur) {
        echo "<fieldset>
            <legend>Modification du joueur ".$joueur['Nom']."</legend>
            <form action=\"ModifierUnJoueur.php\" method=\"post\">
                <p>Licence <input type=\"number\" name =\"Num_Licence\" step=\"any\" pattern=\"\d{0,10}\" value = ".$joueur['Num_Licence']." required /></p>
                <p>Nom <input type=\"text\"  name =\"Nom\" value = ".$joueur['Nom']." required /></p>
                <p>Prénom <input type=\"text\" name =\"Prenom\" value = ".$joueur['Prenom']." /></p>
                <p>Date de naissance <input type=\"text\"  name =\"Date_naissance\" value = ".$joueur['Date_naissance']." required /> <br/>au format AAAA/MM/JJ</p>
                <p>Taille  <input type=\"text\" name =\"Taille\" value = ".$joueur['Taille']." required /></p>
                <p>Poid  <input type=\"text\" name =\"Poid\" value = ".$joueur['Poid']." required /></p>
                <p>Poste préféré <input type=\"text\"  name =\"Poste_pref\" value = ".$joueur['Poste_pref']." required /></p>
                <p>Note  <input type=\"text\"  name =\"note\" value = ".$joueur['note']." required /></p>
                <p>Statut  <input type=\"text\" name =\"Statut\" value = ".$joueur['Statut']." required /></p>

                <input type=\"hidden\" name =\"ex_Licence\" value = ".$joueur['Num_Licence']." />

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
    $exLicence --> Correspond à l'ancienne licence du joueur (la licence avant de l'avoir modifié)
    renvoie 1,2,3,4,5 si erreurs sinon 0

    */
    function modifierUnJoueur($linkpdo, $joueur, $colonne, $nvValeure, $exLicence) {
        //je vérifie si le type de ma nouvelle valeur correspond à ma colonne
        if(verifierType($colonne, $nvValeure) != 0) {
            return verifierType($colonne, $nvValeure); //Renvoie un code d'erreur
        }
        //Je vérifie si ma license n'est pas déjà utilisé
        if($colonne == 'Num_Licence') {
            if(estLicenceExistante($linkpdo, $nvValeure)) {
                if($exLicence != $joueur['Num_Licence']) {
                    return 5; //code d'erreur, si la licence est associé à un autre joueur.
                }
            }
        }
        //Je met à jour ma table joueur.
        UpdateTableAvecId($linkpdo, 'Joueur', $colonne, $nvValeure, 'Num_Licence', $joueur['Num_Licence']);
        return 0;   
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
    function UpdateTableAvecId($linkpdo, $Table, $licence, $nom, $prenom, $naissance, $taille, $poid, $poste, $note, $Statut, $ex_Licence) {
            
        try{
            $strReq = "
                Update ".$Table." 
                SET Num_Licence = :licence, Nom = :nom, prenom = :prenom, Date_naissance = :naissance, Taille = :taille, Poid = :poid, poste_pref = :poste, note = :note, Statut = :Statut
                WHERE Num_Licence = :id
            ";

            $requeteModifierJoueur = $linkpdo->prepare($strReq);

            $requeteModifierJoueur->bindValue(':licence', $licence, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':nom', $nom, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':naissance', $naissance, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':taille', $taille, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':poid', $poid, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':poste', $poste, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':note', $note, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':Statut', $Statut, PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':id', $ex_Licence, PDO::PARAM_STR);

            $requeteModifierJoueur->execute();
        }catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return 1;
        }
        return 0;
    }

    //Retourne le code d'erreur du formulaire modifierJoueur
    function ErreursSaisie($linkpdo, $joueur, $colonne, $valeur, $ex_Licence) {
        $Erreurs = 0;
        switch (modifierUnJoueur($linkpdo, $joueur, $colonne, $valeur, $ex_Licence)) {
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

    //S'il n'y a pas d'erreur. Commit les opérations, et affiche un msg informatif à l'utilisateur.
    function CheckSiErreur($linkpdo, $Erreurs) {
        if($Erreurs==0) {
            $linkpdo->commit();
            echo "l'enregistrement à bien été pris en compte."; 
        }
    }

    /*
        Si $valeur est :
            - une licence alors on vérifie si le chiffre rentré à 10 chiffres. --> renvoie 1 si false
            - Une date de naissance, on vérifie le format YYYY-MM-DD. --> renvoie 2 si false
            - un poid, alors la valeur doit être un chiffre compris entre 40 et 200. --> renvoie 3 si false
            - Taille, alors la valeur doit être compris entre 0 et 272. --> renvoie 4 si false
        Si la valeur correspond à aucun des champs ou bien que les conditions sont validés alors renvoie 0.

        Renvoie 0 si le type est bon, Si return>0 --> le type n'est pas bon
    */
    function verifierType($colonne, $valeur) {
        if($colonne=='Num_Licence') {
            if(!StringIsANumber($valeur, 100000000, 999999999)) {
                return 1;
            }
        }
        /*
        if($colonne == 'Date_naissance') {
            if(!StringIsADate($valeur, 'y-m-d')) {
                return 2;
            }
        }
        */
        if($colonne=='Poid') {
            if(!StringIsANumber($valeur, 40, 200)) {
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


    //Renvoie le msg d'erreur associé au code d'erreur
    function AffichageMsgErreur($Erreurs) {
        switch ($Erreurs) {
            case 1:
                echo "La licence est invalide."; 
                break;
            case 2:
                echo "La date n'est pas au bon format. Veuillez respecter le format YYY-MM-DD. Par exemple 2022/01/23"; 
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
        }
    }
?>