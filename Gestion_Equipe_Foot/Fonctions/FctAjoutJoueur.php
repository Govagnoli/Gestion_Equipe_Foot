<?php
	function formulaireAjoutJoueur() {
        echo "<fieldset>
            <legend>Ajouter du joueur</legend>
            <form action=\"AjoutJoueur.php\" method=\"post\">
                <p>Licence <input type=\"number\" name =\"Num_Licence\" step=\"any\" pattern=\"\d{0,10}\" required /></p>
                <p>Nom <input type=\"text\"  name =\"Nom\" required /></p>
                <p>Prénom <input type=\"text\" name =\"Prenom\" required /></p>
                <p>Date de naissance <input type=\"text\"  name =\"Date_naissance\" required /></p>
                <p>Taille  <input type=\"text\" name =\"Taille\" required /></p>
                <p>Poid  <input type=\"text\" name =\"Poid\" required /></p>
                <p>Poste préféré <input type=\"text\"  name =\"Poste_pref\" required /></p>
                <p>Note  <input type=\"text\"  name =\"note\" required /></p>
                <p>Statut*  <input type=\"text\" name =\"Statut\"/></p>
                <input type=\"submit\" name =\"enregistrer\" value =\"Ajouter\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;
        
        echo "<br>* non obligatoire.";
    }

    function AjoutJoueur($linkpdo, $joueur) {
    	try {
            $strReq = "INSERT INTO joueur VALUES (:Licence, :Nom, :Prenom, )";
            $req = $linkpdo->prepare($strReq);
        } catch(PDOException $e) {
            echo "Erreur : ".$e->getMessage();
        }
    }
?>