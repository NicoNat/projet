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
		<?php 	
				$rep = $bdd->prepare('SELECT * FROM REPONSE WHERE id_utilisateur = ? ORDER BY id_question');
				// Ajouter ID questionnaires
				$rep->execute(array($_SESSION['id']));

				while($donnees = $rep->fetch())
				{
		?>
					<p>
						<strong>Question <?php echo $donnees['id_question']; ?></strong> : <?php echo $donnees['reponse']; ?><br />
					</p>
		<?php
				}				
			$rep->closeCursor(); // Termine le traitement de la requête
		?>
    </body>
    <a href="choix.php">Retour questionnaires</a>
</html>
