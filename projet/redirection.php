<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier de page qui permet à la redirection vers une page souhaitée, le fichier recoit $_GET['id_questionnaire'] et $_POST['id_question']
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

$baz = array("id_questionnaire" => $_GET['id_questionnaire'], "id_question" => $_POST['id_question']);
header("Location: corriger.php?id_questionnaire={$baz['id_questionnaire']}&id_question={$baz['id_question']}");
exit;

?>