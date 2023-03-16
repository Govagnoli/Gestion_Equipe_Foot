
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/FctSaisieMatch.php';
	include './../Fonctions/Requetes.php';
	$linkpdo = connexionBDD();

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
    		$inc = 0;
    		$NbrTituNecessaire = 0;
    		$NbrRempNecessaire = 0;
    		menu();
    		formulaireAjoutMatch($linkpdo);
    		$Id_Matchs = CalculIdMatch($linkpdo);
    		$joueurs = selectAllJoueursActif($linkpdo);
    		$joueurs2 = selectAllJoueursActif($linkpdo);
    		if (!empty($_POST['Date_M']) && !empty($_POST['Lieu_rencontre']) && !empty($_POST['Heure']) && !empty($_POST['opt'])) {
        	    foreach ($joueurs as $jouer){
        	        $inc = $inc + 1;
        	        if ($_POST[$inc] == 'Titulaire'){
        	            $NbrTituNecessaire = $NbrTituNecessaire + 1;
        	        }
        	        if($_POST[$inc] == 'Remplacant'){
        	            $NbrRempNecessaire = $NbrRempNecessaire + 1;
        	        }
        	    }
    		    if ($NbrTituNecessaire > 7 && $NbrTituNecessaire < 12 && $NbrRempNecessaire < 8 ){
    			    $inc = 0;
    			    ajoutMatch($linkpdo, $Id_Matchs, $_POST['Date_M'], $_POST['Lieu_rencontre'], $_POST['Heure'], $_POST['Score_adverse'], $_POST['Score_equipe'], $_POST['opt']);
    				foreach($joueurs2 as $joueur){
    					$inc = $inc + 1;
    					ajouterJoueurMatch( $linkpdo, $joueur['Num_Licence'], $_POST[$inc], $Id_Matchs);
    				}
    		    }else{
    		        if($NbrTituNecessaire < 7){
    		            echo "Nombre de titulaire inssufisant il doit y en avoir plus de 7 et moins de 12";
    		        }elseif($NbrTituNecessaire > 12){
    		            echo "Nombre de titulaire trop grand, il doit y en avoir plus de 7 et moins de 12";
    		        }elseif($NbrRempNecessaire > 8){
    		            echo "Nombre de remplaçant trop grand, il doit y avoir au maximum 7 remplaçant";
    		        }
    		       
    		    }
            }
    	?>
	</body>
</html>