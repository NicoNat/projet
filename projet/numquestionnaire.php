<?php
session_start();
	$id="crepinl";
	$mdp="1108010387S";
	$nsd="mysql:host=webinfo.iutmontp.univ-montp2.fr;dbname=crepinl;charset=UTF8";
	try
				{
					$bdd = new PDO($nsd,$id,$mdp);
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>

    <body>
		<form action=<?php echo "formulairequestionnaire.php?id_questionnaire=".$_GET["id_questionnaire"] ?> method="POST">
			<label>Numéro du questionnaire : <input type="number" name="id_questionnaire" /></label>
			<p><input type="submit" name="valider" value="Valider" href=""></p>
		</form>
			<form action="index.php">
				<p><input type="submit" value="Quitter"p>
			</form>
    </body>
</html>
