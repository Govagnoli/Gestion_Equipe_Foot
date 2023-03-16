<?php
	function formulaireAjoutMatch($linkpdo) {
        $inc = 0;
         echo "<fieldset>
            <legend>Saisir un Match</legend>
            <form action=\"SaisieMatch.php\" method=\"post\">
                <p>Date_M <input type=\"date\"  name =\"Date_M\" required /></p>
                <p>Lieu_rencontre <input type=\"text\" name =\"Lieu_rencontre\" required /></p>
                <p>Heure <input type=\"time\"  name =\"Heure\" required /></p>
                <p>Score_adverse  <input type=\"number\" name =\"Score_adverse\"  min=\"0\" max=\"99\"  required /></p>
                <p>Score_equipe  <input type=\"number\" name =\"Score_equipe\"  min=\"0\" max=\"99\"  required /></p>";
                
                $adversaires = selectAdversaire($linkpdo) ;
                  
                    echo "<label for='options'>Adversaire :</label>
                    <select id='options' name='opt'>";
                    foreach($adversaires as $adversaire){
                       
                        echo "<option value='".$adversaire['Id_Adversaire']."'>".$adversaire['Nom']."</option>";
                    }
                echo "</select> <br> <br>";
                $joueurs = selectAllJoueursActif($linkpdo);
                foreach($joueurs as $joueur){
                    $inc =  $inc + 1;
                    echo"<label for='options'>Joueur : ".$joueur['Nom']." ".$joueur['Prenom']." <br> Titulaire/Remplaçant :</label>
                        <select id='options'  name=".$inc.">
                            <option value='Titulaire'>Titulaire </option>
                            <option value='Remplacant'>Remplaçant</option>
                            <option value='' selected>Non selectionné</option>
                        </select>
                        ";
                  afficherPhotoEtinformations($joueur);
                        
                }
                echo "<input type=\"submit\" name =\"enregistrer\" value =\"Ajouter\">
                <input type=\"reset\" name = \"annuler\" value =\"Annuler\">
            </form>
        </fieldset>" ;
    }
?>