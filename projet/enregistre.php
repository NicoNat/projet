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
			//Enregistre la question.
				$req = $bdd->prepare('INSERT INTO REPONSE(id_utilisateur, id_question, reponse) 
					VALUES(:id_utilisateur, :id_question, :reponse)');
				$req->execute(array(
				'id_utilisateur' => $_SESSION['id'],
				'id_question' => $_GET["id_question"],
				'reponse' => $_POST['message'],
				));
				$req = $bdd->prepare('UPDATE REPONSE SET id_utilisateur=:id_utilisateur, id_question=:id_question, reponse=:reponse
					WHERE id_utilisateur=:id_utilisateur AND id_question=:id_question');
				$req->execute(array(
				'id_utilisateur' => $_SESSION['id'],
				'id_question' => $_GET["id_question"],
				'reponse' => $_POST['message'],
				));
				header("Location: formulaire1.php?id_questionnaire=".$_GET["id_questionnaire"]."&id_question=".$_GET["id_question"]);
				exit;
?>
