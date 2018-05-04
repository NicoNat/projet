<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier de liste de choix des questions.
*La page recoit $_GET['id_questionnaire'].
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*Affichage des questions de du questionnaire correspondant au numero id_questionnaire
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

/*
*Affichage des questions de du questionnaire correspondant au numero id_questionnaire
*/
//Recherche des questions correspondantes au questionnaire numero id_questionnaire

?>
<!DOCTYPE html>
<html>
    <head>
		<link href="css/styles.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>

    <body>
	<?php
echo '<p class="header">Formulaire ' .$_GET['id_questionnaire'].'</p>';
$idQuestions = GetTousId_questionnQuestion($_GET["id_questionnaire"]);
$i = 0;
			?> </br>
			<table>
						<tr>
							<th><?php echo 'Numéro question' ?></th>
							<th><?php echo 'Question' ?></th>
						</tr>
				<tr>
			<?php
while(isset($idQuestions[$i]))
{	?>
	<td> <?php echo "<a href=\"formulaire1.php?id_questionnaire=".$_GET["id_questionnaire"]."&id_question=".$idQuestions[$i]."\">"."Question ".GetNumero_questionQuestion($idQuestions[$i])."</a>" ?> </td>
	<td> <?php echo '' .GetTexteQuestion($idQuestions[$i]); ?> </td>
	<?php
	$i++;
	?> </tr><?php
}
?> </table> </br><?php
echo '<a href="choix.php">Retour</a>';
?>
</body>
</html>
