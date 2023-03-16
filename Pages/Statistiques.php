<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

	include './../Fonctions/Fonctions.php';
	blocageConnexion();
	include './../Fonctions/Requetes.php';
	$linkpdo = connexionBDD();
    $nbrMatchJoue = nbrMatchJoue($linkpdo);
    $nbrMatchGagne = nbrMatchGagne($linkpdo);
    $nbrMatchPerdu = nbrMatchPerdu($linkpdo);
    $nbrMatchExAequo = nbrMatchExAequo($linkpdo);
    $joueurs = selectAllJoueurs($linkpdo);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Statistiques</title>
		<link rel="stylesheet" type="text/css" href="../CSS/Style.css">
	</head>
	<body>
		<?php
			menu(); 
		?>
		<div class="StatGlobales">
		    <!-- Diagramme camembert -->
		    <div class="pieChart">
    		    <label>Nombre de matchs joué</label>
    		    <canvas id="pieChart"></canvas>
    		</div>
    		<div class="StatJoueur">
    		    <!-- Formulaire pour générer les data du tableau -->
    		    <div class="formFiltre">
    		        <?php
    		            formRechercherUnJoueur('./Statistiques.php');
    		        ?>
    		    </div>
    		    <?php
    		        if(!empty($_POST['Nom'])) {
    		            #Tableau affichant les données d'un joueur
            		    echo "<div class='TableauStat'>";
                		    $joueurs = requeteRecupererJoueur($linkpdo, $_POST['Nom'], $_POST['Prenom']);
            		        echo "<div class='TableauStat'>";
                            echo "<table>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Statut</th>
                                    <th>Poste</th>
                                    <th>Match en tant que titulaire</th>
                                    <th>Match en tant que remplaçant</th>
                                    <th>Moyenne des évaluations</th>
                                    <th>Pourcentage match gagnés</th>
                                </tr>";
                                foreach($joueurs as $joueur) {
                                    $nbrMatchgagne = totalMatchGagneJoueur($linkpdo, $joueur['Num_Licence']);
                                    $nbrMatchJoueur = totalMatchJoueur($linkpdo, $joueur['Num_Licence']);
                                    if($nbrMatchJoueur > 0) {
                                        $pourcentageMatchGagneJoueur = $nbrMatchgagne/$nbrMatchJoueur;
                                    } else {
                                        $pourcentageMatchGagneJoueur = "Aucun match joué"; 
                                    }
                                    if(estJoueurEvaluer($linkpdo, $joueur['Num_Licence']) == 0) {
                                        $avgPerfJoueur = "Aucune évaluation";
                                    } else {
                                        $avgPerfJoueur = moyennePerfJoueur($linkpdo, $joueur['Num_Licence']);
                                    }
                                    echo "<tr>
                                        <td>".$joueur['Nom']."</td>
                                        <td>".$joueur['Prenom']."</td>
                                        <td>".$joueur['Statut']."</td>
                                        <td>".$joueur['Poste_pref']."</td>
                                        <td>".nbrDeFoisTitulaire($linkpdo, $joueur['Num_Licence'])."</td>
                                        <td>".nbrDeFoisRemplacant($linkpdo, $joueur['Num_Licence'])."</td>
                                        <td>".$avgPerfJoueur."</td>
                                        <td>".$pourcentageMatchGagneJoueur."</td>
                                    </tr>";
                                }
                            echo '</table>';
                        echo '</div>';
    		        } else {
                        $allJoueurs = selectAllJoueurs($linkpdo);
                        echo "<div class='TableauStat'>";
                            echo "<table>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Statut</th>
                                    <th>Poste</th>
                                    <th>Match en tant que titulaire</th>
                                    <th>Match en tant que remplaçant</th>
                                    <th>Moyenne des évaluations</th>
                                    <th>Pourcentage match gagnés</th>
                                </tr>";
                                foreach($allJoueurs as $joueur) {
                                    $nbrMatchgagne = totalMatchGagneJoueur($linkpdo, $joueur['Num_Licence']);
                                    $nbrMatchJoueur = totalMatchJoueur($linkpdo, $joueur['Num_Licence']);
                                    if($nbrMatchJoueur > 0) {
                                        $pourcentageMatchGagneJoueur = $nbrMatchgagne/$nbrMatchJoueur;
                                    } else {
                                        $pourcentageMatchGagneJoueur = "Aucun match joué"; 
                                    }
                                    if(estJoueurEvaluer($linkpdo, $joueur['Num_Licence']) == 0) {
                                        $avgPerfJoueur = "Aucune évaluation";
                                    } else {
                                        $avgPerfJoueur = moyennePerfJoueur($linkpdo, $joueur['Num_Licence']);
                                    }
                                    echo "<tr>
                                        <td>".$joueur['Nom']."</td>
                                        <td>".$joueur['Prenom']."</td>
                                        <td>".$joueur['Statut']."</td>
                                        <td>".$joueur['Poste_pref']."</td>
                                        <td>".nbrDeFoisTitulaire($linkpdo, $joueur['Num_Licence'])."</td>
                                        <td>".nbrDeFoisRemplacant($linkpdo, $joueur['Num_Licence'])."</td>
                                        <td>".$avgPerfJoueur."</td>
                                        <td>".$pourcentageMatchGagneJoueur."</td>
                                    </tr>";
                                }
                            echo '</table>
                        </div>';
                    }
    		    ?>
    		    
    		</div>
		</div>
		
	</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js">
</script>
<script>  
    var ctx = document.getElementById('pieChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Gagnés', 'Perdus', 'Ex Aequo'],
            datasets: [{
                label: 'Nombre de matchs',
                data: [
                    <?php echo $nbrMatchGagne; ?>, <?php echo $nbrMatchPerdu; ?>, <?php echo $nbrMatchExAequo; ?>
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>