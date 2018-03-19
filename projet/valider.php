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
				$requete="SELECT * FROM REPONSE JOIN QUESTION ON QUESTION.id_question=REPONSE.id_question WHERE id_utilisateur = ".$_SESSION['id']." AND id_questionnaire={$_GET["id_questionnaire"]} ORDER BY REPONSE.id_question";
				$rep = $bdd->query($requete);
				$fini=false;
				while(!$fini){
				$reponses=$rep->fetchObject();
				if($reponses==false){
					$fini=true;
				}else{
		?>
					<p>
						<strong>Question <?php echo $reponses->id_question ?></strong> : <?php echo $reponses->reponse ?><br />
					</p>
		<?php
				}
			}				
			$rep->closeCursor(); // Termine le traitement de la requête
		?>
    </body>
    <a href="choix.php">Retour questionnaires</a>
</html>
