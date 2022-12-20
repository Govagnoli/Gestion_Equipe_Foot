<?php 

    function connexionBDD() {
        $server = 'localhost';
        $login = 'root';
        $mdp = '';
        $db = 'foot_management';

        try {
                return new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
            }
                catch (Exception $e) {
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

    function Bouton($redirection, $label){
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
?>