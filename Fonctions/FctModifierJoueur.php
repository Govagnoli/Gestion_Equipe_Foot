<?php
    function formulaireModifierJoueur($joueur) {
        echo "<fieldset>
            <legend>Modification du joueur ".$joueur['Nom']."</legend>
            <form action=\"ModifierUnJoueur.php\" method=\"post\">
                <p>Licence <input type=\"number\" name =\"Num_Licence\" step=\"any\" min=\"100000000\" max=\"999999999\" value = ".$joueur['Num_Licence']." required /></p>
                <p>Nom <input type=\"text\"  name =\"Nom\" value = ".$joueur['Nom']." required /></p>
                <p>Prénom <input type=\"text\" name =\"Prenom\" value = ".$joueur['Prenom']." /></p>
                <p>Date de naissance <input type=\"date\"  name =\"Date_naissance\" value = ".$joueur['Date_naissance']." required /></p>
                <p>Taille  <input type=\"number\" name =\"Taille\" value = ".$joueur['Taille']." min=\"40\" max=\"200\" required /></p>
                <p>Poid  <input type=\"number\" name =\"Poid\" value = ".$joueur['Poid']." min=\"0\" max=\"272\" required /></p>
                <p>Poste préféré <input type=\"text\"  name =\"Poste_pref\" value = ".$joueur['Poste_pref']." required /></p>
                <p>Note * <input type=\"number\" min=\"1\" max=\"5\" name =\"note\" value = ".$joueur['note']." /></p>
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

                <input type=\"hidden\" name =\"ex_Licence\" value = ".$joueur['Num_Licence']."/>

                <input type=\"submit\" name =\"enregistrer\" value =\"Enregistrer\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;
        echo '<p>* champ facultatif.</p>';
    }
?>