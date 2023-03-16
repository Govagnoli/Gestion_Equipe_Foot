<?php 
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/Requetes.php';
	$linkpdo = connexionBDD();
    if(!empty($_GET['joueur'])) {
		$match = $_GET['joueur'];
		$idMatch = $match['Id_Matchs'];
	} else {
		$idMatch = $_POST['match'];
		$match = selectionMatchById($linkpdo, $idMatch);
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Matchs</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">
	</head>
	<body>
		<?php 
			menu();
			$joueurs = selectJoueurByMatch($linkpdo, $match['Id_Matchs']);
			if (count($joueurs) > 0) {
				foreach ($joueurs as $joueur) {
					echo "<div class='AfficherJoueur'>";
						afficherPhotoEtinformations($joueur);
						echo "<div>";
							echo "<fieldset>
					            <legend>Noter sa performance</legend>
					            <form action='Perfomance.php' method='post'>
					                <label>Donner une note de 1 à 5.</label>
					                <p>Performance  <select name=\"performance\">
					                    <option value=\"1\">1</option>;
					                    <option value=\"2\">2</option>;
					                    <option value=\"3\">3</option>;
					                    <option value=\"4\">4</option>;
					                    <option value=\"5\">5</option>;
					                </select></p>
					                <input type=\"hidden\" name =\"match\" value =\"$idMatch\">
					                <input type=\"hidden\" name =\"licence\" value =\"".$joueur['Num_Licence']."\">
					                <input type=\"submit\" name =\"enregistrer\" value =\"Valider\">
					            </form>
					        </fieldset>";
					    echo "</div>";  
					echo "</div>";
					if(!empty($_POST['performance']) && $_POST['licence'] == $joueur['Num_Licence']) {
						if(estJoueurEvaluerDuMatch($linkpdo, $match['Id_Matchs'], $joueur['Num_Licence']) == 1) {
							//$estMAJ = 
							updatePerformanceEvaluer($linkpdo, $_POST['performance'], $joueur['Num_Licence'], $match['Id_Matchs']);
							echo "La performance ".$_POST['performance']." a bien été ajouté au joueur ".$joueur['Nom']." ".$joueur['Prenom'].".";
						} else {
							ajouterPerformance($linkpdo, $_POST['performance'], $match['Id_Matchs'], $joueur['Num_Licence']);
							echo "La performance ".$_POST['performance']." a bien été ajouté au joueur ".$joueur['Nom']." ".$joueur['Prenom'].".";
						}
					}
				}
			} else {
				echo "Aucun joueur ne participe à ce match.";
			}
		?>
	</body>
</html>