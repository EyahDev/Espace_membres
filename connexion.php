<?php 
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));	
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}
	// Déclaration des variables vide pour le fonctionnement de la page
	$messageErreurGlobal = false;
	
	// Vérification si une session est déjà active
	session_start();
	if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {
		header('location: mon_compte.php');
	}

	if (isset($_POST['pseudo']) && isset($_POST['password'])) {	

		// hachage du mot de passe
		$pass_hache = sha1($_POST['password']);

		// Vérification de utilisateur et du mot de passe dans la base de données
		$reqConnexion = $bdd->prepare('SELECT ID FROM espace_membres WHERE pseudo = :pseudo AND password = :password');
		$reqConnexion->execute(array(
			'pseudo' => htmlspecialchars($_POST['pseudo']),
			'password' => $pass_hache
			));

		$verifConnexion = $reqConnexion->fetch();
		$reqConnexion->closeCursor();

		// Gestion des erreurs de formulaires de la page de connexion
		// Si tout est KO 
		if (!$reqConnexion) {
			$messageErreurGlobal = "<p style=\"color: red;\">Vos identifiants ne sont pas valide !</p>";
		} else {
			session_start();
			$_SESSION['pseudo'] = $_POST['pseudo'];
			$_SESSION['connecte'] = true;
			header('location: mon_compte.php');
		}
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

				<?php echo $messageErreurGlobal;?>
				<input type="submit" name="envoyer"	value="Connexion"/><br/>

				<a href="inscription.php" class="creation_compte">Créer un compte</a>
			</form>
		</div>
	</body>
</html>