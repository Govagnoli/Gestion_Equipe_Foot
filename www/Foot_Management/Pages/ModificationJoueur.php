<?php
	if(!empty($_POST['Licence']) || (!empty($_POST['Nom']) && !empty($_POST['Prenom']))) {
		$server = "localhost";
		$login = "root";
		$mdp = "";
		$db = "foot_management";

		try {
			$linkpdo = new PDO("mysql:host=$server; dbname=$db", $login, $mdp);
		}
		 	catch (Exception $e) {
		 	die('Erreur : ' . $e->getMessage());
		}
		chmod("../../../projet-photos", 0755);
		$repertoirePhoto = "../../../projet-photos/projet-photos/";
	}	
?>
	
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gestion Joueurs</title>
		<link rel="stylesheet" type="text/css" href="./../CSS/Style.css">
        <title></title>
	</head>
	<body>
		<header>
			<nav>
			  	<ul>
			  		<li><a href="../index.html">Accueil</a></li>
		    		<li class="deroulant"><a href="#">Gestion des Joueurs &ensp;</a>
		      		<ul class="sous">
				        <li><a href="./RechercheJoueur.html">Rechercher un joueur</a></li>
				        <li><a href="./AjoutJoueur.html">Ajouter un joueur</a></li>
			      	</ul>
			    	</li>
			    </ul>
			</nav>
		</header>		
		<?php if(!empty($_POST['Licence'])) :
				$reqLicense = $linkpdo->prepare('
					SELECT *
					FROM Joueur
					where Num_Licence = :NumLicence			
				');

				$reqLicense->execute(array(
					'NumLicence' => $_POST['Licence']
				));

				$data = $reqLicense->fetchAll(PDO::FETCH_ASSOC);
		?>
			<?php foreach ($data as $Joueur) : ?>
				<img src=<?php echo "\"".$Joueur['Photo']."\""?>/>
				<?php echo "\"".$repertoirePhoto.$Joueur['Photo']."\"" ?>
				<?php 
					echo "<div class=\"ResRechercheJoueur\">
						<ul>
							<li>Licence : ".$Joueur['Num_Licence']."</li>
							<li>Licence : ".$Joueur['Nom']."</li>
							<li>Prénom : ".$Joueur['Prenom']." </li>
							<li>Date de naissance : ".$Joueur['Date_naissance']." </li>
							<li>Taille : ".$Joueur['Taille']." </li>
							<li>Poid : ".$Joueur['Poid']." </li>
							<li>Poste préféré : ".$Joueur['Poste_pref']."</li>
							<li>Note : ".$Joueur['note']." </li>
							<li>Statut : ".$Joueur['Statut']."</li>
						</ul>
					</div>";
				?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php
			if(!empty($_POST['Nom']) && !empty($_POST['Prenom'])) :
				$reqNom = $linkpdo->prepare('
					SELECT *
					FROM Joueur
					where Nom = :Nom
					AND Prenom = :Prenom
				');

				$reqNom->execute(array(
					'Nom' => $_POST['Nom'],
					'Prenom' => $_POST['Prenom']
				));

				$data = $reqNom->fetchAll(PDO::FETCH_ASSOC);
		?>
			<?php foreach ($data as $Joueur) : ?>
				<img src="<?php echo $repertoirePhoto.$Joueur['Photo'] ?>" alt="" height="42" width="42" />
				<?php
					echo "<div class=\"ResRechercheJoueur\">
						<ul>
							<li>Licence : ".$Joueur['Num_Licence']."</li>
							<li>Licence : ".$Joueur['Nom']."</li>
							<li>Prénom : ".$Joueur['Prenom']." </li>
							<li>Date de naissance : ".$Joueur['Date_naissance']." </li>
							<li>Taille : ".$Joueur['Taille']." </li>
							<li>Poid : ".$Joueur['Poid']." </li>
							<li>Poste préféré : ".$Joueur['Poste_pref']."</li>
							<li>Note : ".$Joueur['note']." </li>
							<li>Statut : ".$Joueur['Statut']."</li>
						</ul>
					</div>";
				?>
			<?php endforeach; ?>
		<?php endif; ?>
	</body>
</html>


