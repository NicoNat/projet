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
		<h1><?php echo htmlspecialchars($_SESSION['login']) . ' ' . htmlspecialchars($_SESSION['password']);?></h1>
		<?php
			$requete="SELECT id_questionnaire FROM QUESTIONNAIRE";
			$resultat=$bdd->query($requete);
			$questions=$resultat->fetchObject();
			$id=$_GET["id_questionnaire"]
			if($questions->nb==$id){
				echo "Ce questionnaire existe déjà. Si vous ne souhaitez pas le remplacer, modifier votre numéro de questionnaire.";
			}
			?>
		<form action=<?php echo "enregistre2.php?id_questionnaire=".$_GET["id_questionnaire"] ?> method="POST">
			<textarea name="message" rows="8" cols="45" ><?php echo $texte ?></textarea>
			<p><input type="submit" name="valider" value="Valider" href=""></p>
		</form>
			<form action="choix.php">
				<p><input type="submit" name="Fin questionnaire" value="Fin"></p>
			</form>
    </body>
</html>
