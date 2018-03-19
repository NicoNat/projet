<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>

    <body>
	<h1><?php echo htmlspecialchars($_SESSION['nom']) . ' ' . htmlspecialchars($_SESSION['prenom']);?></h1>
		
		<textarea name="message" rows="8" cols="45">
			Saisisez votre réponse.
		</textarea>
			<p><input type="submit" name="valider" value="Valider" action="<?php $_SESSION['reponse1'] = $_POST['message']; ?>"</p>
			
			<p><input type="submit" name="Fin questionnaire" value="Fin" action="Valider.php"</p>

			<p>Test: tu t'appels <?php echo htmlspecialchars($_SESSION['nom']) . ' ' . htmlspecialchars($_SESSION['prenom']);?> </p>
			<p>Tes réponses:</p>
			
			<!-- htmlspecialchars protection contre faille XSS -->
			
    </body>
</html>