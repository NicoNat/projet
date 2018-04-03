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

/*
*Création des variables utiles.
*i -> variable d'incrémentation dans diverses parties du code
*/
$i = 1;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>

    <body>
	<?php

	/*
	*Message de bienvenue à l'utilisateur.
	*/
	echo 'Bienvenue ' .$_SESSION['login'];

	/*
	*Affichage des formulaires.
	*Connaître le nombre de formulaire pour connaitre le nombre de formulaire à afficher
	*/
	//Compter le nombre de formulaires présents
	$nbQuestionnaires = CompteNbTuples('QUESTIONNAIRE');

	while($i <= $nbQuestionnaires) //Il faut changer $i
		{
			//Vérifier s'il a répondu aux questions avant d'afficher les formulaires 
			//On regarde le nombre de question du questionnaire\\
			$nbQuestions = CompteNbQuestion($i);

			//On regarde le nombre de réponses de l'utilisateur avec le questionnaire correspondant\\
			$nbReponses = CompteNbReponse($i, $_SESSION['id']);

			//Selon le résultat obtenus des nombre réponses et nombre questions du même questionnaire\\
			if($nbReponses == $nbQuestions && $nbQuestions != 0) //Si toutes les réponses sont faites, on ne donne pas accès
			{
				SautLigneDansPhp(1);
				echo 'Formulaire' .$i .': ' .$nbReponses .'/' .$nbQuestions .' <a href="valider.php">Voir réponse</a>';
			}
			//Si toutes les questions n'ont pas leurs réponses, on donne accès à listequestion.php avec en paramètre le id_questionnaire du id_questionnaire
			elseif($nbReponses < $nbQuestions)
			{
				?>
					</br>
					<a href="listequestions.php?id_questionnaire=<?php echo $i ?>">Formulaire <?php echo $i ?></a>
				<?php
					echo ': ' .$nbReponses .'/' .$nbQuestions;					
			}
			//Si c'est un formulaire sans question on affiche pas la possibilité de voir les réponses.
			elseif (($nbReponses == $nbQuestions && $nbQuestions == 0))
			{
				SautLigneDansPhp(1);
				echo 'Formulaire' .$i .': ' .$nbReponses .'/' .$nbQuestions;
			}
			//Si aucunes des deux propositions précédents, alors il y a un problème dans la matrice ^^
			else
			{
				SautLigneDansPhp(1);
				echo 'Probleme, contacter l\'administrateur';
			}
			
			//Incrémentation $i
			$i = $i +1;
		}
		SautLigneDansPhp(4);

		/*
		*Affichage de la partie privée aux proffesseurs.
		*Si la colonne 'Prof' dans la bdd est à '1', alors on donne l'accès à cette partie
		*/
		//S'il est prof alors afficher sa partie
		if($_SESSION['prof'] == 1)
		{
			echo 'Vous êtes prof';
			SautLigneDansPhp(1);
			echo 'Modifier un formulaire:';
			SautLigneDansPhp(2);
			
			//Affichage des formulaires
			$id_questionnaire = GetTousId_questionnaireQuestionnaire();
			$i = 0;
			while(isset($id_questionnaire[$i]))
			{
				echo 'Formulaire: ' .$id_questionnaire[$i];
				SautLigneDansPhp(1);
				echo 'Nom: ' .GetNomQuestionnaire($id_questionnaire[$i]);
				SautLigneDansPhp(1);
				echo 'Description: ' .GetDescriptionQuestionnaire($id_questionnaire[$i]);
				SautLigneDansPhp(1);
				echo '<a href="modifier.php?id_questionnaire='.$id_questionnaire[$i].'">Modifier</a> / <a href="modifier.php?id_questionnaire='.$id_questionnaire[$i].'">Supprimer question</a> / <a href="corriger.php?id_questionnaire='.$id_questionnaire[$i].'">Corriger</a> / <a href="supprimer.php?id_questionnaire='.$id_questionnaire[$i].'">Supprimer questionnaire</a>';
				SautLigneDansPhp(2);
				$i++;
			}
			echo '<a href="update.php?type=addQuestionnaire">Ajouter Questionnaire</a>';
			?>
			<form action="update.php?type=addQuestionnaire" method="POST" >
				</br>
					<textarea name="nom" rows="4" cols="45" >Nom du questionnaire</textarea>
					<textarea name="description" rows="4" cols="45" >Descrition du questionnaire</textarea>
				</br></br>
				<p><input type="submit" name="valider" value="Ajoutez votre questionnaire" href=""></p>
			</form>
			<?php
		}
	?>
    </body>
</html>
