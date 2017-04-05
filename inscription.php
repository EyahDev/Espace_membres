<?php
	// Connexion à la base de données
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=cours_php;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));	
	} catch (Exception $e) {
		die('Erreur : ' . $e->getMessage());
	}

	// Déclaration des variables vide pour le fonctionnement de la page
	$erreurPseudo = false;

	// Vérification du pseudo

	if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordVerif'])) {
		
		// vérification du pseudo dans la base de donneés
		$reqPseudo = $bdd->prepare('SELECT pseudo FROM espace_membres WHERE pseudo = ?');
		$reqPseudo->execute(array(htmlspecialchars($_POST['pseudo'])));
		$verifPseudo = $reqPseudo->fetch();

		if ($_POST['pseudo'] == $verifPseudo['pseudo']) {
			$erreurPseudo = "<p style=\"color: red;\">Ce pseudo existe déjà !</p>";
		} else {
			echo "<p style=\"color: red;\">Ce pseudo existe pas !</p>";
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
				<?php echo $erreurPseudo; ?>

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