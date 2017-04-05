<?php 

	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));	
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Connexion à l'espace membres</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="access_connexion">
			<form action="connexion.php" method="POST">

				<label for="pseudo">Pseudo</label>
				<input type="text" name="pseudo" id="pseudo" size="15"/><br/>

				<label for="mot_de_passe">Mot de passe</label>
				<input type="password" name="password" id="mot_de_passe" size="15"/><br/>

				<input type="submit" name="envoyer"	value="Connexion"/><br/>

				<a href="inscription.php" class="creation_compte">Créer un compte</a>
			</form>
		</div>
	</body>
</html>