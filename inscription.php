<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));	
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}

	// Déclaration des variables vide pour le fonctionnement de la page
	$erreurPseudo = false;
	$erreurMail = false;
	$erreurMdp = false;
	$confirmationInscription = false;
	// Vérification si une session est ouverte
	session_start();
	if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {
		header('location: mon_compte.php');
	}
	// Vérification si les champs sont définis

	if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerif'])) {
		
		// vérification du  mail dans la base de donneés
		$reqPseudo = $bdd->prepare('SELECT pseudo FROM espace_membres WHERE pseudo = ? ');
		$reqPseudo->execute(array(htmlspecialchars($_POST['pseudo'])));
		$verifPseudo = $reqPseudo->fetch();
		$reqPseudo->closeCursor();

		// vérification du mail dans la base de donneés
		$reqMail = $bdd->prepare('SELECT email FROM espace_membres WHERE email = ? ');
		$reqMail->execute(array(htmlspecialchars($_POST['email'])));
		$verifMail = $reqMail->fetch();
		$reqMail->closeCursor();

		include 'erreur.php';

		// Si tout est ok, on ecrit les informations dans la base de données
		if ((strtolower($_POST['pseudo']) != strtolower($verifPseudo['pseudo'])) && (strtolower($_POST['email']) != $verifMail['email']) && ($_POST['password'] == $_POST['passwordVerif'])) {

			// hachage du mot de passe 
			$pass_hache = sha1($_POST['password']);

			//Ecriture dans la base de données
			$reqEcriture = $bdd->prepare('INSERT INTO espace_membres(pseudo, password, email, date_inscription) VALUES (:pseudo, :password, :email, CURDATE())');
			$reqEcriture->execute(array(
				'pseudo' => htmlspecialchars($_POST['pseudo']),
				'password' => $pass_hache,
				'email' => htmlspecialchars(strtolower($_POST['email']))
			));
			$reqEcriture->closeCursor();
			$confirmationInscription = "<p style=\"color: Green;\">L'inscription s'est bien passé !<br/><a href=\"connexion.php\">Connectez vous</a></p>";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Inscription à l'espace membres</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="contenu_inscription">
			<form action="inscription.php" method="POST">
				<h3>Formulaire d'inscription à l'espace membres</h3>
				<?php echo $confirmationInscription; ?>
				<?php echo $erreurPseudo; ?>
				<?php echo $erreurMail; ?>
				<?php echo $erreurMdp; ?>

				<label class="lab_inscription" for="pseudo">Votre pseudo</label>
				<input type="text" name="pseudo" required/><br/>

				<label class="lab_inscription" for="email">Votre email</label>
				<input type="email" name="email" required/><br/>

				<label class="lab_inscription" for="password">Votre mot de passe</label>
				<input type="password" name="password" required/><br/>

				<label class="lab_inscription" for="passwordVerif">Vérification du mot de passe</label>
				<input type="password" name="passwordVerif" required/><br/>
				
				<input type="submit" name="envoyer" value="Inscription"/>
			</form>
		</div>
	</body>
</html>