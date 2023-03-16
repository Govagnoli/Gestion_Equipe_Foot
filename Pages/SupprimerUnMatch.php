<?php 
    include './../Fonctions/Fonctions.php';
    blocageConnexion();
    include './../Fonctions/Requetes.php';
    $linkpdo = connexionBDD();

	if(!empty($_GET['joueur'])) {
		$match = $_GET['joueur'];
	}  
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Matchs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title>Suppression d'un Match</title>
	</head>
	<body>
		<?php 
			menu();
			$code = 0;
			try {
				$stmt = $linkpdo->prepare('DELETE FROM matchs WHERE Id_Matchs = :Id_Matchs');

				$stmt->bindValue(':Id_Matchs', $match['Id_Matchs'], PDO::PARAM_INT);
				$stmt->execute();
			} catch(PDOException $e) {
            	echo "Erreur : " . $e->getMessage();
            	$code++;
        	}

        	if($code == 0) {
        		echo "Le Match a bien été supprimé";
        	} else {
        		echo "Une erreur est survenue pendant l'opération. Veuillez recommencer.";
        	}

		?>
	</body>
</html>
<!DOCTYPE HTML>