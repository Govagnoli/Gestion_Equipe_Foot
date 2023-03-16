<?php
    function formulaireModifierMatch($Match, $nomAdversaire) {
        echo "<fieldset>
            <legend>Modification du Match du ".$Match['Date_M']." contre l'équipe ".$nomAdversaire."</legend>
            <form action=\"ModifierUnMatch.php\" method=\"post\">
                <p>Date <input type=\"date\"  name =\"Date_M\" value = ".$Match['Date_M']." required /></p>
                <p>Lieu * <input type=\"text\" name =\"Lieu_rencontre\" value = ".$Match['Lieu_rencontre']." /></p>
                <p>Heure <input type=\"time\"  name =\"Heure\" value = ".$Match['Heure']." min=\"00:00:00\" max=\"23:59:59\" required /></p>
                <p>Score adversaire * <input type=\"int\" name =\"Score_adverse\" value = ".$Match['Score_adverse']." min=\"0\" max=\"99\" /> valeur par défault 0</p>
                <p>Score de l'équipe * <input type=\"int\"  name =\"Score_equipe\" value = ".$Match['Score_equipe']." min=\"0\" max=\"99\" /> valeur par défault 0</p>
                <input type=\"hidden\" name =\"Id_Matchs\" value = ".$Match['Id_Matchs']." />
                <input type=\"hidden\" name =\"Id_Adversaire\" value = ".$Match['Id_Adversaire']." />
                <input type=\"submit\" name =\"enregistrer\" value =\"Enregistrer\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;
        echo "<p>* non obligatoire</p>";
    }
?>