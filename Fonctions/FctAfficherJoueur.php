<?php 

	function selectAll($linkpdo) {
        return $linkpdo->query('SELECT * FROM Joueur');		
	}
?>