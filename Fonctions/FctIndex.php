<?php 
	
	//Vérifie si l'identifiat et le mot de passe rentré dans le formulaire sont corrects. Puis permet au manager de se connecter
	function seConnecter($login, $pwd) {
		if(strtoupper($login) == 'HABIBI' && $pwd == '1234') {
			return true;
		}
		return false;
	}

	function formAfficherCookie($label) {
		if ($_SESSION['Connecter']) {
            return $_COOKIE[$label];
        }
        return '';
	}
?>