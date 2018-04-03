<?php
/*
*Créé le 21 Mars 2018, MT.
*Fichier de choix de l'actions principale
*Initialisation de la connexion de la base de donnée et vérification des erreurs en adéquation.
*Lancement de la session.
*Création des variables utiles.
*Message de bienvenue à l'utilisateur.
*Affichage des formulaires.
*Connaître le nombre de formulaire pour connaitre le nombre de formulaire à afficher
*Affichage de la partie privée aux proffesseurs.
*Modification: Date/Initiales/Choses_modifiées
*23 Mars 2018/MT/Réecriture des echo en une ligne
*28 Mars 2018/NN/Ajout de la partie suppression d'un questionnaire
*3 Avril 2018/MT/Modification de l'accès aux formulaire, correction d'un problème en cas de formulaire vide
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
?>



<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>
    <body>

    	<form action=test2.php method="POST" >
			<textarea name="rep" rows="4" cols="45" >Ajoutez votre reponse</textarea>
			<p><input type="submit" name="valider" value="Valider votre reponse" href=""></p>
		</form>

		<?php
		//Partie comparaison en chaine de caractère.
		SautLigneDansPhp(2);
		if (isset($_GET['type']) && $_GET['type'] == 'yes')
		{
			echo 'Vous avec le point.';
		}
		elseif (isset($_GET['type']) && $_GET['type'] == 'no')
		{
			echo "Vous n'avez pas le point.";
		}
		//Partie comparaison d'un tableau.
		$arr1 = array(1, 2, 3, 4);
		$arr2 = array(1, 2, 3, 5);
		SautLigneDansPhp(1);
		echo "Celui-ci doit être true: " .EgalArray($arr1, $arr1);
		SautLigneDansPhp(1);
		echo "Celui-ci doit être false: " .EgalArray($arr1, $arr2);
		SautLigneDansPhp(2);
		$sql = "SHOW FIELDS FROM QUESTION";
		$result = $bdd->query($sql);
		$i=0;

		if (!$result)
		{
		   echo "Erreur DB, impossible de lister les tables\n";
		   echo 'Erreur MySQL : ' . mysql_error();
		   exit;
		}
		else
		{
			while ($don = $result->fetch())
			{
				$id[$i] = $don;
				$i++;
			}
		}
		$result->closeCursor();
		print_r($id);
		SautLigneDansPhp(2);
		print_r($id[0]);
		$m = $id[0];
		SautLigneDansPhp(2);
		print_r($m);
		SautLigneDansPhp(2);
		print_r($m[0]);
		SautLigneDansPhp(2);
		echo $id[0][0];
		SautLigneDansPhp(2);
		echo "Ok je test la boucle";
		SautLigneDansPhp(2);
		$i = 0;
		while (isset($id[$i][0]))
		{
			echo $id[$i][0];
			SautLigneDansPhp(1);
			$i++;
		}
		?>


    </body>
</html>