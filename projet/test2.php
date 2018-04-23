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

$tamp ="SELECT Marque,Prix FROM VOITURE WHERE Prix>=40000";


//Partie test en chaine de caractère.
/*
if (trim(htmlspecialchars($_POST['rep']), " ") == htmlspecialchars("SELECT Marque,Prix FROM VOITURE WHERE Prix>=40000") && isset($_POST['rep']))
{
    header("Location: test.php?type=yes");
    exit;
}
else
{
    header("Location: test.php?type=no");
    exit;
}
*/

if (isset($_POST['quest']))
{
    $RepProf = ResultatRequete($_POST['quest2']);
    $i=0;
    foreach ($RepProf[0] as $key => $value) {
    // $arr[3] sera mis à jour avec chaque valeur de $arr...
    $tabP[$i] = $key;
    echo "{$key} => {$value} ";
    SautLigneDansPhp(1);
    $i++;
    }

    SautLigneDansPhp(1);

    $RepEtudiant = ResultatRequete($_POST['quest']);
    $i=0;
    foreach ($RepEtudiant[0] as $key => $value) {
    // $arr[3] sera mis à jour avec chaque valeur de $arr...
    $tabE[$i] = $key;
    echo "{$key} => {$value} ";
    SautLigneDansPhp(1);
    $i++;
    }
    SautLigneDansPhp(1);
    print_r($tabP);
    SautLigneDansPhp(1);
    print_r($tabE);
    SautLigneDansPhp(2);

    if (($pareil = EgalArrayD1($tabE, $tabP)) == "true")
    {
        echo "Ok les colonnes sont pareils";
    }
    else
    {
        echo "Non les colonnes ne sont pas pareils";
    }

    SautLigneDansPhp(1);

    if (($pareil = EgalArrayD2($RepEtudiant, $RepProf)) == "true")
    {
        echo "Ok, ils sont égaux";
    }
    else
    {
        echo "Non, ils ne sont pas égaux";
    }

    /*
    $test=ResultatRequete($_POST['quest']);
    print_r($test);
    SautLigneDansPhp(2);
    $j = 0; $i = 0;
    while (isset($test[$i][$j]))
    {
        while (isset($test[$i][$j]))
        {
            echo $test[$i][$j] ." ";
            $j++;
        }
        $i++;
        $j=0;
        echo "</br>";
    }

    SautLigneDansPhp(1);
    $melange = array(1, 2, 0, 3, 5);
    $mel = array(5, 2, 0, 3, 1, 4, 9);
    $change;
    $i = 0; $j = 0;
    while (isset($test[$melange[$i]][$j]))
    {
        while (isset($test[$melange[$i]][$mel[$j]]))
        {
            $change[$i][$j] = $test[key($test)][$mel[$j]];
            $j++;
        }
        $i++;
        $melange++;
        $mel++;
        $j=0;
    }

    print_r($change);
    SautLigneDansPhp(2);
    $j = 0; $i = 0;
    while (isset($change[$i][$j]))
    {
        while (isset($change[$i][$j]))
        {
            echo $change[$i][$j] ." ";
            $j++;
        }
        $i++;
        $j=0;
        echo "</br>";
    }


    $tab1 = array (
        0 => array("id_question" => 33, "id_utilisateur" => 11, "réponse" => "miam"),
        1 => array("id_question" => 33, "id_utilisateur" => 89, "réponse" => "jpp"),
        2 => array("id_question" => 33, "id_utilisateur" => 668, "réponse" => "ok")
    );

    SautLigneDansPhp(1);
    print_r($tab1);
    */
}

?>