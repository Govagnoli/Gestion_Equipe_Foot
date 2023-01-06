<?php
	function formulaireAjoutJoueur() {
        echo "<fieldset>
            <legend>Ajouter un joueur</legend>
            <form action=\"AjoutJoueur.php\" method=\"post\">
                <p>Licence <input type=\"number\" name =\"Num_Licence\" step=\"any\" min=\"100000000\" max=\"999999999\" required /></p>
                <p>Nom <input type=\"text\"  name =\"Nom\" required /></p>
                <p>Prénom <input type=\"text\" name =\"Prenom\" required /></p>
                <p>Photo <input type=\"text\" name =\"Photo\" required /></p>
                <p>Date de naissance <input type=\"date\"  name =\"Date_naissance\" required /></p>
                <p>Taille  <input type=\"int\" name =\"Taille\" min=\"40\" max=\"200\" required /></p>
                <p>Poid  <input type=\"int\" name =\"Poid\" min=\"0\" max=\"272\" required /></p>
                <p>Note*  <input type=\"text\"  name =\"note\" /></p>
                <p>Poste  <select name=\"Poste_pref\">
                    <option value=\"Attaquant\">Attaquant</option>;
                    <option value=\"AilierDroit\">Ailier Droit</option>;
                    <option value=\"AilierGauche\">Ailier Gauche</option>;
                    <option value=\"défenseur\">défenseur</option>;
                    <option value=\"Goal\">Goal</option>;
                </select></p>
                <p>Statut  <select name=\"Statut\">
                    <option value=\"Actif\">Actif</option>;
                    <option value=\"Blessé\">Blessé</option>;
                    <option value=\"Suspendu\">Suspendu</option>;
                    <option value=\"Absent\">Absent</option>;
                </select></p>
                <input type=\"submit\" name =\"enregistrer\" value =\"Ajouter\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;        
        echo "<br>* non obligatoire.";
    }



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

?>