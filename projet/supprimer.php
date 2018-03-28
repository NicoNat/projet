<?php
require_once('fonction.php');
require_once('utilisateur.php');
$id_bdd = Id_bdd();

try
{
	$bdd = new PDO($id_bdd['nsd'],$id_bdd['id'],$id_bdd['mdp']);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

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
		
		if($_SESSION['prof'] == 1)
		{
			$resultat = $bdd -> query("DELETE FROM QUESTIONNAIRE WHERE id =".$_GET['id_questionnaire']);
			if($resultat == FALSE){
				die("Erreur : suppression non effectuée");
			}
			else {
				echo "Suppression effectuée <br />";
			}
			
			echo "<br />";
			echo '<a href="choix.php">Accueil</a>';
			
		}
		
		?>
		
    </body>
</html>
