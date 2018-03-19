<?php
session_start();
$_SESSION['question'] = 1;
$i = 0;
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
    </head>

    <body>
			<?php
				$id="crepinl";
				$mdp="1108010387S";
				$nsd="mysql:host=webinfo.iutmontp.univ-montp2.fr;dbname=crepinl;charset=UTF8";
				
				try{
					$bdd = new PDO($nsd,$id,$mdp);
				}catch (Exception $e){
						die('Erreur : ' . $e->getMessage());
				}
				
				$reponse = $bdd->query("SELECT login FROM UTILISATEUR WHERE id_utilisateur = ".$_SESSION['id']);
				$donnees = $reponse->fetchObject();
					if($donnees==false){
						$fini=true;
					}else{
						echo 'Bienvenue ';
						echo $donnees->login;
					}
			?>
		<?php
		//Compter le nombre de formulaires présents
		$reponse = $bdd->query('SELECT COUNT(*) AS nbQuestionnaires FROM QUESTIONNAIRE');
		$donnees = $reponse->fetchObject();
		$nbQuestionnaires = $donnees->nbQuestionnaires;
		$reponse->closeCursor();
		
		$i = 1;
		while($i <= $nbQuestionnaires)
		{
			//Vérifier s'il a répondu aux questions avant d'afficher les formulaires 
			//On regarde le nombre de question du questionnaire\\
			$reponse = $bdd->query('SELECT COUNT(*) AS nbQuestions FROM QUESTION WHERE id_questionnaire = '.$i);
			$donnees = $reponse->fetchObject();
			$nbQuestions = $donnees->nbQuestions;
			$reponse->closeCursor();
			//On regarde le nombre de réponses de l'utilisateur avec le questionnaire correspondant\\
			$reponse = $bdd->query('SELECT COUNT(*) AS nbReponses FROM REPONSE JOIN QUESTION ON QUESTION.id_question=REPONSE.id_question WHERE id_questionnaire = '.$i.' AND id_utilisateur = '.$_SESSION['id']);
			$donnees = $reponse->fetchObject();
			$nbReponses = $donnees->nbReponses;
			$reponse->closeCursor();
			//Selon le résultat obtenus des nombre réponses et nombre questions du même questionnaire\\
			if($nbReponses == $nbQuestions) //Si toutes les réponses sont faites, on ne donne pas accès
			{
				?>
					</br>
				<?php
					echo 'Formulaire';
					echo $i;
					echo ': ';
					echo $nbReponses;
					echo '/';
					echo $nbQuestions;
					echo " <a href=\"valider.php?id_questionnaire=".$i."\">Voir réponse</a>";
			}
			elseif($nbReponses < $nbQuestions) //Si toutes les questions n'ont pas leurs réponses, on donne accès
			{
				?>
					</br>
					<a href="listequestions.php?id_questionnaire=<?php echo $i ?>">Formulaire <?php echo $i ?></a>
				<?php
					echo ': ';
					echo $nbReponses;
					echo '/';
					echo $nbQuestions;
					
			}
			else //Si aucunes des deux propositions précédents, alors il y a un problème dans la matrice ^^
			{
				?>
					</br>
				<?php
				echo 'Probleme, contacter l\'administrateur';
			}
			
			//Incrémentation $i
			$i = $i +1;
		}
	?>
    </body>
</html>
