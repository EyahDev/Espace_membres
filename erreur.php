<?php
	// Gestion des erreurs de formulaires
	// Si tout est KO
	if (($_POST['pseudo'] == $verifPseudo['pseudo']) && ($_POST['email'] == $verifMail['email']) && ($_POST['password'] != $_POST['passwordVerif'])) {

		$erreurPseudo = "<p style=\"color: red;\">Ce pseudo existe déjà !</p>";
		$erreurMail = "<p style=\"color: red;\">Cet email existe déjà !</p>";
		$erreurMdp = "<p style=\"color: red;\">Les mots de passe ne correspondent pas !</p>";

	// Si pseudo et mail sont KO
	} elseif ($_POST['pseudo'] == $verifPseudo['pseudo'] && $_POST['email'] == $verifMail['email']) {
		$erreurPseudo = "<p style=\"color: red;\">Ce pseudo existe déjà !</p>";
		$erreurMail = "<p style=\"color: red;\">Cet email existe déjà !</p>";

	// si pseudo et mot de passe sont KO
	} elseif ($_POST['pseudo'] == $verifPseudo['pseudo'] && $_POST['password'] != $_POST['passwordVerif']) {
		$erreurPseudo = "<p style=\"color: red;\">Ce pseudo existe déjà !</p>";
		$erreurMdp = "<p style=\"color: red;\">Les mots de passe ne correspondent pas !</p>";

	// si pseudo est KO
	} elseif ($_POST['pseudo'] == $verifPseudo['pseudo']) {
		$erreurPseudo = "<p style=\"color: red;\">Ce pseudo existe déjà !</p>";

	// si mail et mot de passe sont KO
	} elseif ($_POST['email'] == $verifMail['email'] && ($_POST['password'] != $_POST['passwordVerif'])) {
		$erreurMail = "<p style=\"color: red;\">Cet email existe déjà !</p>";
		$erreurMdp = "<p style=\"color: red;\">Les mots de passe ne correspondent pas !</p>";

	// si mail est KO
	} elseif ($_POST['email'] == $verifMail['email']) {
		$erreurMail = "<p style=\"color: red;\">Cet email existe déjà !</p>";

	// Si mot de passe est KO
	} elseif (($_POST['password'] != $_POST['passwordVerif'])) {
		$erreurMdp = "<p style=\"color: red;\">Les mots de passe ne correspondent pas !</p>";
	}
?>