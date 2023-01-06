<?php 
	session_start();
    include './../Fonctions/Fonctions.php';
    blocageConnexion();
    
    $linkpdo = connexionBDD();

	if(!empty($_GET['joueur'])) {
		$joueur = $_GET['joueur'];
	}  
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title>Suppression d'un joueur</title>
	</head>
	<body>
		<?php 
			menu($_SESSION['Connecter']);
			$code = 0;
			try {
				$stmt = $linkpdo->prepare('DELETE FROM joueur WHERE num_licence = :num_licence');

				$stmt->bindValue(':num_licence', $joueur['Num_Licence'], PDO::PARAM_INT);
				$stmt->execute();
			} catch(PDOException $e) {
            	echo "Erreur : " . $e->getMessage();
            	$code++;
        	}

        	if($code == 0) {
        		echo "Le joueur a été supprimé";
        	} else {
        		echo "Une erreur est survenue pendant l'opération. Veuillez recommencer.";
        	}

		?>
	</body>
</html>
<!DOCTYPE HTML>