<?php 
    
    //Retourne un objet de type Connection. Permet de se connecter à la base de donner sur le compte de HABIBI.
    function connexionBDD() {
        $server = '127.0.0.1';
        $login = 'cvsastph_HABIBI';
        $mdp = 'lnc+v7cl7#//Z(+(72';
        $db = 'cvsastph_FootManagementSQL';

        try {
            return new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

###############################################################################
###############################################################################
###############                                                 ###############
###############                    Select                       ###############
###############                                                 ###############
###############################################################################
###############################################################################
    
    //Nombre de match gagnés d'un joueur
    function totalMatchGagneJoueur($linkpdo, $Num_Licence) {
        $req = $linkpdo->prepare('
            SELECT count(*)
            FROM matchs m, jouer j
            where m.Id_Matchs = j.Id_Matchs
            and j.Num_Licence = :Num_Licence
            and m.Score_adverse < Score_equipe;
        ');

        $req->execute(array(
            'Num_Licence' => $Num_Licence
        ));

        return $req->fetchColumn();
    }
    
    //Nombre de match joué d'un joueur
    function totalMatchJoueur($linkpdo, $Num_Licence) {
        $req = $linkpdo->prepare('
            SELECT count(*)
            FROM matchs m, jouer j
            where m.Id_Matchs = j.Id_Matchs
            and j.Num_Licence = :Num_Licence
        ');

        $req->execute(array(
            'Num_Licence' => $Num_Licence
        ));

        return $req->fetchColumn();
    }
    
    
    ###
    ### Match
    ###
    
    //Selectionne tous les matchs
    function selectAllMatchs($linkpdo) {
        return $linkpdo->query('SELECT * FROM matchs');		
	}
    
    //Selection d'un match en fonction de son identifiant.
    function selectionMatchById($linkpdo, $Id_Matchs) {
        $req = $linkpdo->prepare('
            SELECT *
            FROM matchs
            where Id_Matchs = :Id_Matchs
        ');

        $req->execute(array(
            'Id_Matchs' => $Id_Matchs
        ));
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    
    
        function getMatchInfo($pdo, $Id_Adversaire) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM `matchs` where Id_Adversaire = :Id_Adversaire");
        $stmt->bindParam(':Id_Adversaire', $Id_Adversaire);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
    
    //Vérfie si un joueur $joueur participe au match $match
	//Renvoie 0 si le joueur n'est pas associé au match, sinon renvoie 1.
	function EstJoueurDuMatch($linkpdo, $Num_Licence, $Id_Matchs) {
	    $reqEstPresent = $linkpdo->prepare("SELECT count(*) FROM jouer where Num_Licence = :Num_Licence and Id_Matchs = :Id_Matchs");
	     $reqEstPresent->bindValue(':Num_Licence', $Num_Licence, PDO::PARAM_STR);
         $reqEstPresent->bindValue(':Id_Matchs', $Id_Matchs, PDO::PARAM_STR);
       
        $reqEstPresent->execute();
        
        return $reqEstPresent->fetchColumn();
	}
	
	
	
	//Retourne le nbr de matchs présent dans la table id Match
    function CalculIdMatch($linkpdo) {
        try {
            $stmt = $linkpdo->prepare("SELECT COUNT(*) FROM matchs"); 
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            return $number_of_rows+1;
        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }   
       
    }
    
    //Selectionne le nombre de match déjà jouer.
    function nbrMatchJoue($linkpdo) {
        try {
            $stmt = $linkpdo->prepare("SELECT COUNT(*) FROM matchs 
                where Score_adverse IS NOT NULL 
                and Score_equipe IS NOT NULL 
                and Score_adverse != '' 
                and Score_equipe != ''"); 
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            return $number_of_rows;
        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }   
    }
    
    //Selectionne le nombre de matchs gagné.
    function nbrMatchGagne($linkpdo) {
        try {
            $stmt = $linkpdo->prepare("SELECT COUNT(*) FROM matchs 
                where Score_adverse IS NOT NULL 
                and Score_equipe IS NOT NULL 
                and Score_adverse != '' 
                and Score_equipe != ''
                and Score_equipe > Score_adverse"); 
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            return $number_of_rows;
        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
    
    //Selectionne le nombre de matchs Perdu.
    function nbrMatchPerdu($linkpdo) {
        try {
            $stmt = $linkpdo->prepare("SELECT COUNT(*) FROM matchs 
                where Score_adverse IS NOT NULL 
                and Score_equipe IS NOT NULL 
                and Score_adverse != '' 
                and Score_equipe != ''
                and Score_equipe < Score_adverse"); 
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            return $number_of_rows;
        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }
    
    //Selectionne le nombre de matchs ex aequo.
    function nbrMatchExAequo($linkpdo) {
        try {
            $stmt = $linkpdo->prepare("SELECT COUNT(*) FROM matchs 
                where Score_adverse IS NOT NULL 
                and Score_equipe IS NOT NULL 
                and Score_adverse != '' 
                and Score_equipe != ''
                and Score_equipe = Score_adverse"); 
            $stmt->execute();
            $number_of_rows = $stmt->fetchColumn(); 
            return $number_of_rows;
        }   
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

	
	###
    ### Joueur
    ###
	
	//Selectionne tous les joueurs de la table Joueur.
	function selectAllJoueurs($linkpdo) {
        return $linkpdo->query('SELECT * FROM joueur ORDER BY 2');		
	}
	
	//Selectionne tous les joueurs avec le statut 'Actif'
	function selectAllJoueursActif($linkpdo) {
        return $linkpdo->query("SELECT * FROM joueur where Statut = 'Actif'");		
	}
	
	//Selectionne un joueur en fonction de son identifiant
    function selectJoueurById($linkpdo, $Licence) {
    $req = $linkpdo->prepare('
        SELECT *
        FROM joueur
        where Num_Licence = :Licence
    ');
    $req->execute(array(
        'Licence' => $Licence
    ));
    return $req->fetchAll(PDO::FETCH_ASSOC);
    }
	
	//Selectionne le ou les joueurs ayant le même nom et prénom
    function requeteRecupererJoueur($linkpdo, $Nom, $Prenom) {
        $reqNom = $linkpdo->prepare('
            SELECT *
            FROM joueur
            where Nom = :Nom
            AND Prenom = :Prenom
        ');
        $reqNom->execute(array(
            'Nom' => $Nom,
            'Prenom' => $Prenom
        ));
        return $reqNom->fetchAll(PDO::FETCH_ASSOC);
    }
    
    ###
    ### Adversaire
    ###
    //selectionne tous les adversaires
    function selectAdversaire($linkpdo) {
            try {
                $strReq = "SELECT * FROM adversaire";
                $req = $linkpdo->prepare($strReq);
                $req->execute();
                $matches = $req->fetchAll(PDO::FETCH_ASSOC);
                return $matches;
            } catch(PDOException $e) {
                echo "Erreur : ".$e->getMessage();
            }
        }
    //Retourne le nom de l'équipe adverse.
    function SelectNomAdversaire($linkpdo, $Id_Adversaire) {
        try {
            $requeteSelectionId = $linkpdo->prepare('SELECT Nom FROM adversaire where Id_Adversaire = :Id_Adversaire');
            $requeteSelectionId->bindValue(':Id_Adversaire', $Id_Adversaire, PDO::PARAM_STR);
            $requeteSelectionId->execute();
            return $requeteSelectionId->fetchColumn();
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
    
    //Renvoie le nombre d'adversaire de la table 'Adversaire'.
    function nouvelIdentifiantAdversaire($linkpdo) {
        $strReq = "Select count(*) from adversaire";
        try {
            $req = $linkpdo->prepare($strReq);
            $req->execute();
            return $req->fetchColumn();
        } catch(PDOException $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }
    
    ###
    ### Jouer
    ###
    
    //Compte le nombre de fois qu'un joueur a été titulaire dans un match
    function nbrDeFoisTitulaire($linkpdo, $Num_Licence) {
        $reqNom = $linkpdo->prepare('
            SELECT count(*)
            FROM jouer
            where Num_Licence = :Num_Licence 
            AND Titulaire = Titulaire
        ');
        $reqNom->execute(array(
            'Num_Licence' => $Num_Licence,
        ));
        return $reqNom->fetchColumn();
    }

    //Compte le nombre de fois qu'un joueur a été remplaçant dans un match
    function nbrDeFoisRemplacant($linkpdo, $Num_Licence) {
        $reqNom = $linkpdo->prepare('
            SELECT count(*)
            FROM jouer
            where Num_Licence  = :Num_Licence
            AND Titulaire = 0
        ');
        $reqNom->execute(array(
            'Num_Licence' => $Num_Licence,
        ));
        return $reqNom->fetchColumn();
    }

    //Selectionne tous les joueurs participant à un match
    function selectJoueurByMatch($linkpdo, $id_Matchs) {
         $req = $linkpdo->prepare('
            SELECT joueur.*
            FROM joueur, jouer
            where jouer.Id_Matchs = :Id_Matchs
            and jouer.Num_Licence = joueur.Num_Licence
        ');
        $req->execute(array(
            ':Id_Matchs' => $id_Matchs
        ));
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    ###
    ### evaluer
    ###

    //Renvoie la moyenne de toutes les performances d'un joueur
    function moyennePerfJoueur($linkpdo, $Num_Licence) {
        $reqNom = $linkpdo->prepare('
            SELECT ROUND(avg(Performance), 2)
            FROM evaluer
            where Num_Licence  = :Num_Licence 
        ');
        $reqNom->execute(array(
            ':Num_Licence' => $Num_Licence
        ));
        return $reqNom->fetchColumn();
    }

    //Vérifie si un joueur associé à son match est présent dans la table evaluer
    function estJoueurEvaluerDuMatch($linkpdo, $Id_Matchs, $Num_Licence) {
        $req = $linkpdo->prepare('
            SELECT count(*)
            from evaluer
            where Num_Licence = :Num_Licence
            and Id_Matchs = :Id_Matchs
        ');
        $req->execute(array(
            ':Num_Licence' => $Num_Licence,
            ':Id_Matchs' => $Id_Matchs
        ));
        return $req->fetchColumn();    
    }

    //Vérifie si un joueur a eu des évaluation
    function estJoueurEvaluer($linkpdo, $Num_Licence) {
        $req = $linkpdo->prepare('
            SELECT count(*)
            from evaluer
            where Num_Licence = :Num_Licence
        ');
        $req->execute(array(
            ':Num_Licence' => $Num_Licence
        ));
        return $req->fetchColumn();    
    }

    
###############################################################################
###############################################################################
###############                                                 ###############
###############                  Insertion                      ###############
###############                                                 ###############
###############################################################################
###############################################################################
    
    ###
    ### Match
    ###
    
    //Ajoute un match dans la table match.
    function ajoutMatch($linkpdo, $Id_Matchs, $Date_M, $Lieu_rencontre, $Heure, $Score_adverse, $Score_equipe, $Id_Adversaire) {
        try {
            // Prépare la requête d'insertion
            $strReq = "INSERT INTO matchs VALUES (:Id_Matchs, :Date_M, :Lieu_rencontre, :Heure, :Score_adverse, :Score_equipe, :Id_Adversaire)";
            $req = $linkpdo->prepare($strReq);
            // Exécute la requête en passant les valeurs en paramètre
            $req->execute(array(
                ':Id_Matchs' => $Id_Matchs,
                ':Date_M' => $Date_M,
                ':Lieu_rencontre' => $Lieu_rencontre,
                ':Heure' => $Heure,
                ':Score_adverse' => $Score_adverse,
                ':Score_equipe' => $Score_equipe,
                ':Id_Adversaire' => $Id_Adversaire
            ));
            echo 'match ajouter';
        } catch(PDOException $e) {
            // Affiche un message d'erreur si une exception est levée
            echo "Erreur : ".$e->getMessage();
        }
    }    
    
	###
    ### Joueur
    ###

    //Permet d'ajouter un joueur dans la table joueur
    function AjoutJoueur($linkpdo, $joueur) {
    	try {
            $strReq = "INSERT INTO joueur VALUES (:licence, :nom, :prenom, :photo, :naissance, :taille, :poid, :poste, :note, :Statut)";
            $req = $linkpdo->prepare($strReq);

            $req->execute(array(
                ':licence' => $joueur['Num_Licence'],
                ':nom' => $joueur['Nom'],
                ':prenom' => $joueur['Prenom'],
                ':photo' => $joueur['Photo'],
                ':naissance' => $joueur['Date_naissance'],
                ':taille' => $joueur['Taille'],
                ':poid' => $joueur['Poid'],
                ':poste' => $joueur['Poste_pref'],
                ':note' => $joueur['note'],
                ':Statut' => $joueur['Statut']
            ));
            echo "<br/><br/>Le joueur à bien été ajouté.";
        } catch(PDOException $e) {
            echo "Erreur : ".$e->getMessage();
            echo "<br/><br/>Une erreur est survenue, veuillez recommencer.";
        }
    }
 
	###
    ### Adversaire
    ###
    
	//Ajoute un Adversaire dans la table 'Adversaire'.
	function AjoutAdversaire($linkpdo, $nom) {
        $id = nouvelIdentifiantAdversaire($linkpdo) + 1;
    	try {
            $strReq = "INSERT INTO adversaire VALUES (:id, :nom)";
            $req = $linkpdo->prepare($strReq);

            $req->execute(array(
                ':id' => $id,
                ':nom' => strtoupper(normalize_string($nom))
            ));
            echo "<br/><br/>L'équipe adverse a bien été ajoutée.";
        } catch(PDOException $e) {
            echo "Erreur : ".$e->getMessage();
            echo "<br/><br/>Une erreur est survenue, veuillez recommencer.";
        }
    }
    
	###
    ### Jouer
    ###
        
    //Ajoute un joueur et un match dans la table jouer. Permet de savoir si un joueur participe à un match. Les joueurs participants peuvent-être titulaire(=1) ou remplaçant(=0)
    function ajouterJoueurMatch($linkpdo, $Titulaire, $Num_Licence, $Id_Matchs) {
        try {
            $strReq = "INSERT INTO jouer VALUES (:Num_Licence, :Titulaire, :Id_Matchs)";
            $req = $linkpdo->prepare($strReq);
            $req->execute(array(
                ':Num_Licence' => $Num_Licence,
                ':Titulaire' => $Titulaire,
                ':Id_Matchs' => $Id_Matchs
            ));
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
     function ajouterJoueurJouer($linkpdo, $Num_Licence, $Titulaire, $Id_Matchs) {
        try {
            
            $strReq = "INSERT INTO jouer (Num_Licence, Titulaire, Id_Matchs) VALUES (:Num_Licence, :Titulaire, :Id_Matchs)";
            $req = $linkpdo->prepare($strReq);
            $req->execute(array(
                ':Num_Licence' => $Num_Licence,
                ':Titulaire' => $Titulaire,
                ':Id_Matchs' => $Id_Matchs
            ));
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    function ajouterPerformance($linkpdo, $Performance, $Id_Matchs, $Num_Licence) {
        try {
            $strReq = "INSERT INTO evaluer VALUES (:Num_Licence, :Performance, :Id_Matchs)";
            $req = $linkpdo->prepare($strReq);

            $req->bindValue(':Performance', $Performance, PDO::PARAM_STR);
            $req->bindValue(':Num_Licence', $Num_Licence, PDO::PARAM_STR);
            $req->bindValue(':Id_Matchs', $Id_Matchs, PDO::PARAM_STR);

            $req->execute();
        } catch (PDOException $e) {
            echo "La performance : $Performance \nL'id match : $Id_Matchs \n l'id licence : $Num_Licence \n \n";
            echo "Error: " . $e->getMessage();
        }
    }
	
	
###############################################################################
###############################################################################
###############                                                 ###############
###############                    Update                       ###############
###############                                                 ###############
###############################################################################
###############################################################################

    /*
        $linkpdo --> Object de type connection
        $Table --> Correspond au String du nom de la table à modifier
        $Colonne --> String du nom de la colonne à modifier (de la table $table)
        $nvValeure --> la nouvelle valeur à de la colonne $colonne à modifier
        $id --> l'identifiant de la table $table
        $valeurId --> Valeur de l'identifiant, pour connaitre l'élement unique à modifier
    
        Met à jour une donnée d'une table avec l'identifiant associé
    */
    function UpdateTableAvecId($linkpdo, $Table, $Match, $Colonne) {
        try{
            $strReq = "
                Update ".$Table." 
                SET ".$Colonne." = :".$Colonne." 
                WHERE Id_Matchs = :Id_Matchs
            ";
            $requeteModifierMatch = $linkpdo->prepare($strReq);
            $requeteModifierMatch->execute(array(
                    ':'.$Colonne => $Match[$Colonne],
                    ':Id_Matchs' => $Match['Id_Matchs']
                ));
        }catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return 1;
        }
        return 0;
    }

    ###
    ### Match
    ###


    ###
    ### Joueur
    ###

    /*
        $linkpdo --> Object de type connection
        $Table --> Correspond au String du nom de la table à modifier
        $Colonne --> String du nom de la colonne à modifier (de la table $table)
        $nvValeure --> la nouvelle valeur à de la colonne $colonne à modifier
        $id --> l'identifiant de la table $table
        $valeurId --> Valeur de l'identifiant, pour connaitre l'élement unique à modifier
    
        Met à jour toutes les données de la table joueur avec l'identifiant associé ($ex_Licence)
        
        nécessite un refactoring
    */
    function UpdateJoueurAvecId($linkpdo, $joueur, $ex_Licence) {
        try{
            $strReq = "
                Update joueur
                SET Num_Licence = :licence, Nom = :nom, prenom = :prenom, Date_naissance = :naissance, Taille = :taille, Poid = :poid, poste_pref = :poste, note = :note, Statut = :Statut
                WHERE Num_Licence = :id
            ";

            $requeteModifierJoueur = $linkpdo->prepare($strReq);

            $requeteModifierJoueur->bindValue(':licence', $joueur['Num_Licence'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':nom', $joueur['Nom'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':prenom', $joueur['Prenom'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':naissance', $joueur['Date_naissance'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':taille', $joueur['Taille'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':poid', $joueur['Poid'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':poste', $joueur['Poste_pref'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':note', $joueur['note'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':Statut', $joueur['Statut'], PDO::PARAM_STR);
            $requeteModifierJoueur->bindValue(':id', $ex_Licence, PDO::PARAM_STR);

            $requeteModifierJoueur->execute();
        }catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return 1;
        }
        return 0;
    }

    ###
    ### Adversaire
    ###
    
    
    ###
    ### Jouer
    ###
    
	//Met à jour la colonne Titulaire de la table Jouer. Modifie le rôle d'un joueur associé à un match.
	function updateJouerTitulaire($linkpdo, $estTitulaire, $Num_Licence, $Id_Matchs) {
	    try{
	        $stmt = $linkpdo->prepare("UPDATE jouer SET titulaire = :titulaire WHERE Num_Licence = :Num_Licence AND Id_Matchs = :Id_Matchs");
            
            $stmt->bindValue(':titulaire', $estTitulaire, PDO::PARAM_STR);
            $stmt->bindValue(':Num_Licence', $Num_Licence, PDO::PARAM_STR);
            $stmt->bindValue(':Id_Matchs', $Id_Matchs, PDO::PARAM_STR);
            
            $stmt->execute();
            echo "modification effectuée";
	    } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } 
	}   
		//Met à jour la colonne Titulaire de la table Jouer. Modifie le rôle d'un joueur associé à un match.
	function deleteJouerJoueur($linkpdo, $Num_Licence, $Id_Matchs) {
	    try{
	        $stmt = $linkpdo->prepare("DELETE FROM jouer WHERE Num_Licence = :Num_Licence AND Id_Matchs = :Id_Matchs");
            
            $stmt->bindValue(':Num_Licence', $Num_Licence, PDO::PARAM_STR);
            $stmt->bindValue(':Id_Matchs', $Id_Matchs, PDO::PARAM_STR);
            
            $stmt->execute();
	    } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } 
	}   

    ###
    ### evaluer
    ###

    //Met à jour la performance d'un joueur sur un match. 
    function updatePerformanceEvaluer($linkpdo, $Performance, $Num_Licence, $Id_Matchs) {
        try{
            $stmt = $linkpdo->prepare("UPDATE evaluer SET Performance = :Performance WHERE Num_Licence = :Num_Licence AND Id_Matchs = :Id_Matchs");
            $stmt->bindValue(':Performance', $Performance, PDO::PARAM_STR);
            $stmt->bindValue(':Num_Licence', $Num_Licence, PDO::PARAM_STR);
            $stmt->bindValue(':Id_Matchs', $Id_Matchs, PDO::PARAM_STR);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        } 
    }

?>