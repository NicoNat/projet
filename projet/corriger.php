<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier de page qui permet à l'utilisateur prof de corriger les réponses des utilisateurs étudiants
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*Création des variables utiles.
*Vérifie si l'utilisateur est prof
*Modification: Date/Initiales/Choses_modifiées
*23 Mars 2018/MT/Réecriture des echo en une ligne
*
*
*/

/*
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*/
//Appel du fichier contenant les variables
require_once('fonction.php');
require_once('utilisateur.php');
require_once('pointsutilisateur.php');
$id_bdd = Id_bdd();
//Vérification de la connexion à la bdd
try
{
	$bdd = new PDO($id_bdd['nsd'],$id_bdd['id'],$id_bdd['mdp']);
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
	if(isset($_GET['id_question']) && $_SESSION['prof'] == 1)
	{
		/*
		*Affichage du menu déroulant de choix des questions.
		*/
		echo "<h1>Questionnaire: " .$_GET['id_questionnaire'] .", question numéro: " .GetNumero_questionQuestion($_GET['id_question']) ."</h1>";
		?>
		<form method="post" action= <?php echo "redirection.php?id_questionnaire=" .$_GET['id_questionnaire']; ?>>
 
       	<label for="pays">Choix de la question</label><br />
       	<select name="id_question" id="id_question">
		<?php
 
 
		$num = GetTousnumero_questionnQuestion($_GET['id_questionnaire']);
		$num2 = GetTousId_questionnQuestion($_GET['id_questionnaire']);
 		$i = 0;
		while (isset($num[$i]))
		{
			?>
			<option name="id_question" value=" <?php echo $num2[$i]; ?>"> <?php echo "Question " .$num[$i]; ?></option>
			<?php
			$i++;
		}
		?>
		</select>
		<p><input type="submit" name="valider" value="Changer de question" href=""></p>
		</form>
		<?php
		/*
		*Affichage des réponses.
		*/
		?>
		<form method="post" action="<?php echo 'notation.php?id_questionnaire=' .$_GET['id_questionnaire'] .'&id_question=' .$_GET['id_question']; ?>">
		<?php
		if (isset($_GET['id_question']))
		{
			$reponses = GetTousReponseReponse($_GET['id_question']);
			$id_utilisateur = GetTousId_utilisateurReponse($_GET['id_question']);
		}
		$i = 0;
		while(isset($reponses[$i]))
		{
		?>
			<input type="checkbox" name="<?php echo $id_utilisateur[$i]; ?>" id="<?php echo $id_utilisateur[$i]; ?>" />
			<strong>Reponse: </strong><?php echo $reponses[$i]; ?><br />
		<?php
			$i++;
		}
		?>
			<p><input type="submit" name="valider" value="Valide la correction" href=""></p>
		</form>
		<?php
		/*
		*Reception et affichage des notes.
		*/
		//Reception des notes.
		$userssend = file_get_contents('store');
		$notes = unserialize($userssend);
		$i = 0;
		while(isset($notes[$i]))
		{
			echo "L'étudiant " .GetLoginUtilisateur($notes[$i]->getId_utilisateur()) ." a obtenu " .$notes[$i]->getPoints($_GET['id_questionnaire']) ." bonnes réponses</br>";
			print_r($notes[$i]);
			echo "</br>";
			$i++;
		}
	}	
	elseif (!isset($_GET['id_question']) && $_SESSION['prof'] == 1)
	{
		header("Location: corriger.php?id_questionnaire=" .$_GET['id_questionnaire'] ."&id_question=" .Get1erId_questionQuestion($_GET['id_questionnaire']));
		exit;	
	}
	else
	{
		header("Location: choix.php");
		exit;
	}
	?>
    </body>
</html>