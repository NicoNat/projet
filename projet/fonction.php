<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier fonction à utiliser dans les différents pages.
*Utiliser require('fonction.php'); pour appeler le fichier.
*include va réécrire alors que require va chercher dans le fichier.
	-Id-bdd 								/ Fonction initialisation de la bdd et ouverture de session
	-SautLignedansPhp 						/ Fonction saut de ligne par </br>
	-InfoUserIntoSession 					/ Fonction de remplissage des informations de $_SESSION
	-CompteNbTuples		 					/ Fonction pour compter le nombre de tuples d'un questionnaire.
	-CompteNbQuestion 						/ Fonction pour compter le nombre de questions d'un formulaire précis.
	-CompteNbReponse 						/ Fonction pour compter le nommbre de réponse aux question d'un formulaire précis, faites par un utilisateur précis.
	-GetTousId_questionnaireQuestionnaire	/ Fonction qui renvoie tous les id_questionnaire du tableau QUESTIONNAIRE.
	-GetNomQuestionnaire					/ Fonction qui renvoie le nom du questionnaire ciblé.
	-GetDescriptionQuestionnaire			/ Fonction qui renvoie la description du questionnaire ciblé.
	-GetTousId_questionnQuestion 			/ Fonction qui renvoie tous les id_question en fonction de l'id_questionnaire choisie.
	-GetNumero_questionQuestion				/ Fonction qui renvoie le numéro de la question ciblée.
	-GetTexteQuestion						/ Fonction qui renvoie le texte de la question ciblée.
	-VerifierSiDejaReponse					/ Fonction qui renvoie si la question à déja une réponse.
	-AjouterReponse							/ Fonction qui ajoute une réponse à la bdd.
	-UpdateReponse							/ Fonction qui met à jour un réponse de la bdd.
	-GetTousLesUtilisateurs					/ Fonction qui renvoie tous les utilisateurs.
	-GetPasswordUtilisateur					/ Fonction qui renvoie le password de l'utilisateur.
	-GetIdUtilisateurs						/ Fonction qui renvoie le password de l'utilisateur.
	-AjouterUtilisateur						/ Fonction enregistre un utilisateur.
	-GetTousId_questionRepondues			/ Fonction renvoie les numero des questions répondues par l'utilisateur.
	-GetReponseReponse   					/ Fonction renvoie la réponse d'une question.
	-UpdateQuestion 						/ Fonction renvoie la réponse d'une question.
	-AjouterQuestion						/ Fonction qui ajoute une question à la bdd.
	-DeleteQuestion							/ Fonction qui retire une/des question précise à la bdd.
	-Get1erId_questionQuestion				/ Fonction qui renvoie le premier id_question du questionnaire.
	-GetTousnumero_questionnQuestion		/ Fonction qui renvoie tous les numero_question d'un questionnaire
	-GetTousReponseReponse					/ Fonction qui renvoie le texte de toutes les réponses à une question
	-GetTousId_utilisateurReponse			/ Fonction qui renvoie l'id_utilisateur de toutes les réponses à une question.
	-GetLoginUtilisateur					/ Fonction qui renvoie le pseudo de l'utilisateur.
	-ModifiePoints							/ Fonction qui ajoute un nombre de points à la case point d'une réponse
	-GetNote 								/ Fonction qui accède à view et qui renvoie le nombre de point d'un utilisateur à un questionnaire
	-AjouterQuestionnaire					/ Fonction qui ajoute un questionnaire à la bdd.
	-GetPoints 								/ Fonction qui retourne le nombre de point qu'a gagné l'étudiant pour cette réponse.
	-
	-
	-
*Modification: Date/Initiales/Choses_modifiées
*22 Mars 2018/MT/Ajout fonctions: CompteNbQuestion, CompteNbQuestion, CompteNbReponse, GetTousId_questionnaireQuestionnaire, GetNomQuestionnaire, GetDescriptionQuestionnaire, GetTousId_questionnQuestion, GetNumero_questionQuestion, GetTexteQuestion, VerifierSiDejaReponse, AjouterReponse, UpdateReponse, GetTousLesUtilisateurs, GetPasswordUtilisateur, GetIdUtilisateurs
*23 Mars 2018/MT/Ajout fonctions: AjouterUtilisateur, GetTousId_questionRepondues, GetReponseReponse, UpdateQuestion, AjouterQuestion
*24 Mars 2018/MT/Ajout fonctions: DeleteQuestion, Get1erId_questionQuestion, GetTousnumero_questionnQuestion, GetTousReponseReponse
*25 MArs 2018/MT/Ajout fonctons: GetTousId_utilisateurReponse
*27 Mars 2018/MT/Ajout fonction: GetLoginUtilisateur
*28 Mars 2018/MT/Ajout fonctions: ModifiePoints, GetNote, AjouterQuestionnaire
*31 Mars 2018/MT/Ajout fonction: GetPoints,
*04 Avril 2018/NN/Ajout fonction: SupprimerQuestionnaire
*/



/**
*Fonction initialisation de la bdd et ouverture de session.
*@return array 0->string, 1->string, 3->string
*/
function Id_bdd()
{
	//Création de session
	session_start();

	//Initialisation des variables pour l'initialisation de la bdd
	$id_bdd = array (
    'id' => 'crepinl',
    'mdp' => '1108010387S',
    'nsd' => 'mysql:host=webinfo.iutmontp.univ-montp2.fr;dbname=crepinl;charset=UTF8');
    return $id_bdd;
}

/**
*Fonction saut de ligne par </br>.
* @param integer $nombre
*/
function SautLigneDansPhp($nombre)
{
	for ($i=0; $i < $nombre; $i++)
	{ 
		echo '</br>';
	}
}

/**
*Fonction de remplissage des informations de $_SESSION.
* @param string $id
* @param string $login
* @param boolean(0-9) $prof
*/
function InfoUserIntoSession($id, $login, $prof)
{
	$_SESSION['login'] = $login;
	$_SESSION['prof'] = $prof;
	$_SESSION['id'] = $id;
}

/**
*Fonction pour compter le nombre de tuples d'un questionnaire.
* @param string $nom
* @return integer 
*/
function CompteNbTuples($nom)
{
	global $bdd;
	$nb = $bdd->query('SELECT COUNT(*) AS nbQuestionnaires FROM QUESTIONNAIRE =' .$nom);
	$don = $nb->fetchObject();
	$nb2 = $don->nbQuestionnaires;
	$nb->closeCursor();
	return $nb2;
}

/**
*Fonction pour compter le nombre de questions d'un formulaire précis.
* @param integer $id_utilisateur
* @return integer
*/
function CompteNbQuestion($id_questionnaire)
{
	global $bdd;
	$nb = $bdd->query('SELECT COUNT(*) AS nbQuestions FROM QUESTION WHERE id_questionnaire = '.$id_questionnaire);
	$don = $nb->fetchObject();
	$nb2 = $don->nbQuestions;
	$nb->closeCursor();
	return $nb2;
}

/**
*Fonction pour compter le nommbre de réponse aux question d'un formulaire précis, faites par un utilisateur précis.
* @param integer $id_questionnaire
* @param integer $id_utilisateur
* @return integer
*/
function CompteNbReponse($id_questionnaire, $id_utilisateur)
{
	global $bdd;
	$nb = $bdd->query('SELECT COUNT(*) AS nbReponses FROM REPONSE JOIN QUESTION ON QUESTION.id_question=REPONSE.id_question WHERE id_questionnaire = '.$id_questionnaire.' AND id_utilisateur = '.$id_utilisateur);
	$don = $nb->fetchObject();
	$nb2 = $don->nbReponses;
	$nb->closeCursor();
	return $nb2;
}

/**
*Fonction qui renvoie tous les id_questionnaire du tableau QUESTIONNAIRE.
* @return integer array des id_questionnaire
*/
function GetTousId_questionnaireQuestionnaire()
{
	global $bdd;
	$i = 0;
	$rep = $bdd -> query("SELECT id_questionnaire FROM QUESTIONNAIRE");
	while ($don = $rep->fetch())
	{
		$id[$i] = $don['id_questionnaire'];
		$i++;
	}
	$rep->closeCursor();
	return $id;
}

/**
*Fonction qui renvoie le nom du questionnaire ciblé.
* @param integer $id_questionnaire
* @return string
*/
function GetNomQuestionnaire($id_questionnaire)
{
	global $bdd;
	$rep = $bdd -> query('SELECT nom FROM QUESTIONNAIRE WHERE id_questionnaire='.$id_questionnaire);
	$don = $rep->fetchObject();
	$rep2 = $don->nom;
	$rep->closeCursor();
	return $rep2;
}
/**
*Fonction qui renvoie la description du questionnaire ciblé.
* @param integer $id_questionnaire
* @return string
*/
function GetDescriptionQuestionnaire($id_questionnaire)
{
	global $bdd;
	$rep = $bdd -> query('SELECT description FROM QUESTIONNAIRE WHERE id_questionnaire='.$id_questionnaire);
	$don = $rep->fetchObject();
	$rep2 = $don->description;
	$rep->closeCursor();
	return $rep2;
}

/**
*Fonction qui renvoie tous les id_question en fonction de l'id_questionnaire choisie.
* @param integer $id_questionnaire
* @return integer array tableau des id_question dans l'ordre croissant des numero_question
*/
function GetTousId_questionnQuestion($id_questionnaire)
{
	global $bdd;
	$i = 0;
	$rep = $bdd -> prepare("SELECT id_question FROM QUESTION WHERE id_questionnaire = ? ORDER BY numero_question");
	$rep->execute(array($id_questionnaire));
	while ($don = $rep->fetch())
	{
		$id[$i] = $don['id_question'];
		$i++;
	}
	$rep->closeCursor();
	if(isset($id))
	{
	return $id;
	}
}

/**
*Fonction qui renvoie le numéro de la question ciblée.
* @param integer $id_question
* @return integer
*/
function GetNumero_questionQuestion($id_question)
{
	global $bdd;
	$rep = $bdd -> query('SELECT numero_question FROM QUESTION WHERE id_question='.$id_question);
	$don = $rep->fetchObject();
	$rep2 = $don->numero_question;
	$rep->closeCursor();
	return $rep2;
}

/**
*Fonction qui renvoie le texte de la question ciblée.
* @param integer $id_question
* @return string
*/
function GetTexteQuestion($id_question)
{
	global $bdd;
	$rep = $bdd -> query('SELECT texte FROM QUESTION WHERE id_question='.$id_question);
	$don = $rep->fetchObject();
	$rep2 = $don->texte;
	$rep->closeCursor();
	return $rep2;
}

/**
*Fonction qui renvoie si la question à déja une réponse.
* @param integer $id_utilisateur
* @param integer $id_question
* @return boolean (0-Pas de réponse. 1-Déjà une réponse)
*/
function VerifierSiDejaReponse($id_utilisateur, $id_question)
{
	global $bdd;
	$rep=$bdd->query("SELECT COUNT(*) nb FROM REPONSE WHERE id_utilisateur =".$id_utilisateur." AND id_question=".$id_question);
	$question=$rep->fetchObject();
	$rep2 = $question->nb;
	$rep->closeCursor();
	return $rep2;
}

/**
*Fonction qui renvoie le texte de la réponse.
* @param integer $id_utilisateur
* @param integer id_question
*/
function GetTexteReponse($id_utilisateur, $id_question)
{
	global $bdd;
	$req=$bdd->query("SELECT * FROM REPONSE WHERE id_utilisateur =".$id_utilisateur." and id_question=" .$id_question);
	$texte=$req->fetchObject();
	$texte2=$texte->reponse;
	return $texte2;
	$req->closeCursor();
}

/**
*Fonction qui ajoute une réponse à la bdd.
* @param integer $id_utilisateur
* @param integer $id_question
* @param string $texte
*/
function AjouterReponse($id_utilisateur, $id_question, $texte_reponse)
{
	global $bdd;
	$req = $bdd->prepare('INSERT INTO REPONSE(id_utilisateur, id_question, reponse) 
		VALUES(:id_utilisateur, :id_question, :reponse)');
	$req->execute(array(
		'id_utilisateur' => $id_utilisateur,
		'id_question' => $id_question,
		'reponse' => $texte_reponse,
	));
	$req->closeCursor();
}

/**
*Fonction qui met à jour un réponse de la bdd.
* @param integer $id_utilisateur
* @param integer $id_question
* @param string $texte
*/
function UpdateReponse($id_utilisateur, $id_question, $texte)
{
	global $bdd;
	echo 'Dans update' .$id_utilisateur .' ' .$id_question .' ' .$texte;
	$req = $bdd->prepare('UPDATE REPONSE SET reponse = :Q WHERE id_question = :id_question and id_utilisateur = :id_utilisateur');
	$req -> execute(array(
		'Q' => $texte,
		'id_question' => $id_question,
		'id_utilisateur' => $id_utilisateur
	));
}

/**
*Fonction qui renvoie tous les utilisateurs.
* @return string array des login utilisateurs
*/
function GetTousLesUtilisateurs()
{
	global $bdd;
	$i = 0;
	$rep = $bdd -> query("SELECT login FROM UTILISATEUR");
	while ($don = $rep->fetch())
	{
		$login[$i] = $don['login'];
		$i++;
	}
	$rep->closeCursor();
	return $login;
}

/**
*Fonction qui renvoie le password de l'utilisateur.
* @param string $login
* @return string
*/
function GetPasswordUtilisateur($login)
{
	global $bdd;
	$req = $bdd->prepare("SELECT * FROM UTILISATEUR WHERE login= ?");
	$req->execute(array($login)); //Erreur de merde car on peut pas faire login=".$login
	$don = $req->fetchObject();
	$req2 = $don->password;
	$req->closeCursor();
	return $req2;
}

/**
*Fonction qui renvoie le id_utilisateur de l'utilisateur.
* @param string $login
* @return integer 
*/
function GetIdUtilisateur($login)
{
	global $bdd;
	$req=$bdd->prepare("SELECT id_utilisateur FROM UTILISATEUR WHERE login= ?");
	$req->execute(array($login));
	$id=$req->fetchObject();
	$id2=$id->id_utilisateur;
	$req->closeCursor();
	return $id2;
}

/**
*Fonction enregistre un utilisateur.
* @param string $login
* @param string $password
* @param integer(0-9) $prof
*/
function AjouterUtilisateur($login, $password, $prof)
{
	global $bdd;
	$req = $bdd->prepare('INSERT INTO UTILISATEUR(login, password, prof,) 
		VALUES(:login, :password, :prof)');
	$req->execute(array(
		'login' => $login,
		'password' => $password,
		'prof' => $prof,
	));
	$req->closeCursor();
}
/**
*Fonction renvoie les numero des questions répondues par l'utilisateur.
* @param integer $id_utilisateur
* @return integer array tableau des id_question
*/
function GetTousId_questionRepondues($id_utilisateur)
{
	global $bdd;
	$rep = $bdd->prepare('SELECT * FROM REPONSE WHERE id_utilisateur = ?');
	$rep->execute(array($id_utilisateur));
	$i = 0;
	while($don = $rep->fetch())
	{
		$info[$i] = $don['id_question'];
		$i++;
	}				
	$rep->closeCursor();
	return $info;
}

/**
*GetReponseReponseFonction renvoie la réponse d'une question.Fonction renvoie la réponse d'une question.
* @param integer $id_utilisateur
* @param integer $id_question
* @return string
*/
function GetReponseReponse($id_utilisateur, $id_question)
{
	global $bdd;
	$req = $bdd->prepare('SELECT reponse FROM REPONSE WHERE id_utilisateur = ? and id_question = ?');
	$req->execute(array($id_utilisateur, $id_question));
	$rep=$req->fetchObject();
	$rep2=$rep->reponse;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction renvoie la réponse d'une question.
* @param integer $id_question
* @param integer $texte
* @param integer $numero_question
*/
function UpdateQuestion($id_question, $texte, $numero_question)
{
	global $bdd;
	$req = $bdd->prepare('UPDATE QUESTION SET texte = :Q WHERE id_question = :id_question');
	$req -> execute(array(
		'Q' => $texte,
		'id_question' => $id_question
	));
	$req->closeCursor();
	$req = $bdd->prepare('UPDATE QUESTION SET numero_question = :Q WHERE id_question = :id_question');
	$req -> execute(array(
		'Q' => $numero_question,
		'id_question' => $id_question
	));
	$req->closeCursor();
}

/**
*Fonction qui ajoute une question à la bdd.
* @param integer $id_questionnaire
* @param string $texte
*/
function AjouterQuestion($id_questionnaire, $texte, $numero_question)
{
	global $bdd;
	$req = $bdd->prepare("INSERT INTO QUESTION(id_questionnaire, texte, numero_question) 
						VALUES(:id_questionnaire, :texte, :numero_question)");
	$req->execute(array(
		'id_questionnaire' => $id_questionnaire,
		'texte' => $texte,
		'numero_question' => $numero_question
	));
}

/**
*Fonction qui retire une/des question précise à la bdd.
* @param integer $id_question
*/
function DeleteQuestion($id_question)
{
	global $bdd;
	$req = $bdd->exec("DELETE FROM QUESTION WHERE id_question=" .$id_question);
}

/**
*Fonction qui renvoie le premier id_question du questionnaire
* @param $id_questionnaire
* @return integer array des id_question dans 'ordre des numero_question'
*/
function Get1erId_questionQuestion($id_questionnaire)
{
	global $bdd;
	$i = 0;
	$rep = $bdd -> prepare("SELECT id_question FROM QUESTION WHERE id_questionnaire = ? ORDER BY numero_question");
	$rep->execute(array($id_questionnaire));
	while ($don = $rep->fetch())
	{
		$id[$i] = $don['id_question'];
		$i++;
	}
	$rep->closeCursor();
	return $id[0];
}

/**
*Fonction qui renvoie tous les numero_question d'un questionnaire
* @param int $id_questionnaire
* @return integer array des numéros_question dans l'ordre croissant des id_questionnaires
*/
function GetTousnumero_questionnQuestion($id_questionnaire)
{
	global $bdd;
	$i = 0;
	$rep = $bdd -> query("SELECT numero_question FROM QUESTION WHERE id_questionnaire =" .$id_questionnaire);
	while ($don = $rep->fetch())
	{
		$num[$i] = $don['numero_question'];
		$i++;
	}
	$rep->closeCursor();
	return $num;
}

/**
*Fonction qui renvoie le texte de toutes les réponses à une question.
* @param integer $id_question
* @return string array des textes réponses dans l'ordre croissant des id_utilisateurs
*/
function GetTousReponseReponse($id_question)
{
	global $bdd;
	$i = 0;
	$req = $bdd -> prepare("SELECT reponse FROM REPONSE WHERE id_question = ? ORDER BY id_utilisateur");
	$req->execute(array($id_question));
	while ($don = $req->fetch())
	{
		$rep[$i] = $don['reponse'];
		$i++;
	}
	$req->closeCursor();

	if(isset($rep))
	{
	return $rep;
	}
}

/**
* Fonction qui renvoie l'id_utilisateur de toutes les réponses à une question.
* @param int $id_question
* @return $rep Tableau dans l'ordre croissant des id_utilisateurs d'une question précise
*/
function GetTousId_utilisateurReponse($id_question)
{
	global $bdd;
	$i = 0;
	$req = $bdd -> prepare("SELECT id_utilisateur FROM REPONSE WHERE id_question = ? ORDER BY id_utilisateur");
	$req->execute(array($id_question));
	while ($don = $req->fetch())
	{
		$rep[$i] = $don['id_utilisateur'];
		$i++;
	}
	$req->closeCursor();

	if(isset($rep))
	{
	return $rep;
	}
}

/**
*Fonction qui renvoie le pseudo de l'utilisateur
* @param integer $id_utilisateur
* @return string pseudo de l'utilisateur
*/
function GetLoginUtilisateur($id_utilisateur)
{
	global $bdd;
	$req = $bdd->prepare('SELECT login FROM UTILISATEUR WHERE id_utilisateur = ?');
	$req->execute(array($id_utilisateur));
	$rep=$req->fetchObject();
	$rep2=$rep->login;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction qui ajoute un nombre de points à la case point d'une réponse
* @param integer $id_utilisateur
* @param integer $id_question
* @param integer $points
*/
function ModifiePoints($id_utilisateur, $id_question, $points)
{
	global $bdd;
	$req = $bdd->prepare('UPDATE REPONSE SET points = :Q WHERE id_question = :id_question AND id_utilisateur = :id_utilisateur');
	$req -> execute(array(
		'Q' => $points,
		'id_question' => $id_question,
		'id_utilisateur' => $id_utilisateur
	));
}

/**
*Fonction qui accède à view et qui renvoie le nombre de point d'un utilisateur à un questionnaire
* @param integer $id_utilisateur
* @param integer $id_questionnaire
* @return integer
*/
function GetNote($id_utilisateur, $id_questionnaire)
{
	global $bdd;
	$req = $bdd->prepare('SELECT * FROM NOTEPARQUESTIONNAIRE WHERE id_utilisateur = ? AND id_questionnaire = ?');
	$req->execute(array($id_utilisateur, $id_questionnaire));
	$rep=$req->fetchObject();
	$rep2=$rep->notes;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction qui ajoute un questionnaire à la bdd.
* @param string $nom
* @param string $description
*/
function AjouterQuestionnaire($nom, $description)
{
	global $bdd;
	$req = $bdd->prepare("INSERT INTO QUESTIONNAIRE(nom, description) 
						VALUES(:nom, :description)");
	$req->execute(array(
		'nom' => $nom,
		'description' => $description,
	));
}

/**
*Fonction qui supprime un questionnaire de la bdd
* @param integer $id_questionnaire
*/

function SupprimerQuestionnaire($id_questionnaire)
{
	global $bdd;
	$req = bdd->prepare('DELETE FROM REPONSE WHERE id_question IN (SELECT id_question FROM QUESTION WHERE id_questionnaire = ?);
			DELETE FROM QUESTION WHERE id_questionnaire IN (SELECT id_questionnaire FROM QUESTIONNAIRE WHERE id_questionnaire = ?);
			DELETE FROM QUESTIONNAIRE WHERE id_questionnaire = ?');
	$req->execute(array($id_questionnaire));
}

/**
*Fonction qui retourne le nombre de point qu'a gagné l'étudiant pour cette réponse.
* @param integer $id_utilisateur
* @param integer $id_question
* @return integer points
*/
function GetPoints($id_utilisateur, $id_question)
{
	global $bdd;
	$req = $bdd->prepare('SELECT points FROM REPONSE WHERE id_utilisateur = ? AND id_question = ?');
	$req->execute(array($id_utilisateur, $id_question));
	$rep=$req->fetchObject();
	$rep2=$rep->points;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction qui retourne le texte réponse d'une question.
* @param integer $id_question
* @return string
*/
function getReponseProf($id_question)
{
	global $bdd;
	$req = $bdd->prepare('SELECT bonneReponse FROM QUESTION WHERE id_questionnaire = ?');
	$req->execute(array($id_question));
	$rep=$req->fetchObject();
	$rep2=$rep->bonneReponse;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction qui retourne le résultat d'une requête sql
* @param string $requete
* @return array 
*/
function ResultatRequete($requete)
{
	global $bdd;
	$req = $bdd->exec('' .$requete);
	$rep=$req->fetchObject();
	$rep2=$rep;
	$req->closeCursor();
	return $rep2;
}

/**
*Fonction qui test l'exacte similitude entre deux tableaux
* @param array $tab_etudiant
* @param array $tab_prof
* @return string
*/
function EgalArray($tab_etudiant, $tab_prof)
{
	if (count($tab_etudiant) == count($tab_prof))
	{
		$i = 0;
		$erreur = "true";
		while(isset($tab_prof[$i]) && $erreur == "true")
		{
			if ($tab_prof[$i] == $tab_etudiant[$i])
			{
				$erreur = "true";
			}
			else
			{
				$erreur = "false";
			}
			$i++;
		}
	}
	return $erreur;
}
?>
