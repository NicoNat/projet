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
				$req = $bdd->prepare('INSERT INTO QUESTIONNAIRE(id_questionnaire, nom, description) 
					VALUES(:id_questionnaire, :nom, :description)');
				$req->execute(array(
				'id_questionnaire' => $_GET['id_questionnaire'],
				'nom' => $_POST['nomquestionnaire'],
				'description' => $_POST['descquestionnaire'],
				));
				$req = $bdd->prepare('UPDATE QUESTIONNAIRE SET id_questionnaire=:id_questionnaire, nom=:nom, description=:description
					WHERE id_questionnaire=:id_questionnaire');
				$req->execute(array(
				'id_questionnaire' => $_GET['id_questionnaire'],
				'nom' => $_POST['nomquestionnaire'],
				'description' => $_POST['descquestionnaire'],
				));
				// header("Location: formulairequestionnaire.php?id_questionnaire=".$_GET["id_questionnaire"].");
				exit;
?>
