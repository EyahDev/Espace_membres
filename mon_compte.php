<?php
	session_start();
	$confConnexion = '<p>Félicitation ' . $_SESSION['pseudo'] .', tu es connecté(e) ! <br/><a href="deconnexion.php">Déconnexion...</a></p>';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Connecté à l'espace membres</title>
	</head>
	<body>
		<?php echo $confConnexion; ?>
	</body>
</html>