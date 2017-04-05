<?php
	session_start();
	$_SESSION = array();
	session_destroy();
	$ConfirmationDeconnection = '<p>Vous êtes déconnecté. <a href="connexion.php">Retour</a></p>'
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Déconnexion</title>
	</head>
	<body>
		<?php echo $ConfirmationDeconnection; ?>
	</body>
</html>