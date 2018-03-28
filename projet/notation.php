<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier de page qui permet de compter les points des réponses des utilisateurs étudiants
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

/*
*Vérifie que l'utilisateur est prof
*/
if($_SESSION['prof'] == 1)
{
	$userssend = file_get_contents('store');
	$users = unserialize($userssend);
	$num = GetTousId_utilisateurReponse($_GET['id_question']);
	$i = 0;
	while (isset($num[$i]))
	{
		if(isset($users[$i]) && isset($_POST[$num[$i]]) && $_POST[$num[$i]] == 'on')
		{
			$users[$i]->point($_GET['id_questionnaire'], 1);
			echo '</br>Ne créer pas';
		}
		elseif(isset($_POST[$num[$i]]) && $_POST[$num[$i]] == 'on')
		{
			$users[$i] = new PointsUtilisateur($num[$i]);
			$users[$i]->point($_GET['id_questionnaire'], 1);
			echo "</br>Créer";
		}
		print_r($users[$i]);
		echo "</br>J'prend l'id_utilisateur " .$users[$i]->getId_utilisateur() ."</br>";
		$i++;
	}
	$userssend = serialize($users);
	// enregistre $s quelque part où corriger.php peut le retrouver
	file_put_contents('store', $userssend);
}

$baz = array("id_questionnaire" => $_GET['id_questionnaire'], "id_question" => $_GET['id_question']);
header("Location: corriger.php?id_questionnaire={$baz['id_questionnaire']}&id_question={$baz['id_question']}");
exit;


?>