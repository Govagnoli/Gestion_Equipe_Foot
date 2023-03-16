<?php
    function AfficherInformationsMatch($match) {
        echo "
            <fieldset> 
				<legend>Match numéros : ".$match['Id_Matchs']."</legend>
				<p> ID match : ".$match['Id_Matchs']." </p>
				<p> Date du match : ".$match['Date_M']."</p>
				<p> Lieux de la rencontre : ".$match['Lieu_rencontre']."</p>
				<p> Heure du match : ".$match['Heure']."</p>
				<p> Score de l'équipe adverse : ".$match['Score_adverse']."</p>
				<p> Score de l'équipe : ".$match['Score_equipe']."</p>
				<p>ID de l'adversaire : ".$match['Id_Adversaire']."</p>
			</fieldset>
        ";
    }



