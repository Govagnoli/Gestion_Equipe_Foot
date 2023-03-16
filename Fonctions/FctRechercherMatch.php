<?php
	function formulaireRechercheMatch($linkpdo) {
        echo "<fieldset>
            <legend>Rechercher un Match</legend>
            <form action=\"RechercherMatch.php\" method=\"post\">";
                 echo "<label for='options'> rechercher les matchs joué contre : </label>";
                $adversaires = selectAdversaire($linkpdo);
                echo"<select id='options'  name='adversaire'>";
                        foreach($adversaires as $adversaire){
                            echo"
                            <option value='".$adversaire['Id_Adversaire']."'>".$adversaire['Nom']."</option>";
                        }
                echo "</select>";
                echo"<input type=\"submit\" name =\"enregistrer\" value =\"rechercher\"> 
            </form>
        </fieldset>" ;
    }
?>



