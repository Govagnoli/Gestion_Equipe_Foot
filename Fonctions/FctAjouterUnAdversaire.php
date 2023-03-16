<?php
	function formulaireAjoutAdversaire() {
        echo "<fieldset>
            <legend>Ajouter un adversaire</legend>
            <form action=\"AjouterUnAdversaire.php\" method=\"post\">
                <label>Veuillez rentrer le nom d'une équipe adverse.</label>
                <p>Nom <input type=\"text\"  name =\"Nom\" required /></p>
                <input type=\"submit\" name =\"enregistrer\" value =\"Ajouter\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;        
    }

    function normalize_string($str) {
        $normalizer = Normalizer::normalize($str, Normalizer::FORM_D);
        $regex = '~\p{M}~u';
        return preg_replace($regex, '', $normalizer);
    }
?>