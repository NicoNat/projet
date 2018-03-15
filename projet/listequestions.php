<?php

$id="crepinl";
$mdp="1108010387S";
$nsd="mysql:host=webinfo.iutmontp.univ-montp2.fr;dbname=crepinl;charset=UTF8";
try{
	$sgbd=new PDO($nsd,$id,$mdp);
}catch(PDOException $e){
	die("Echec à la connexion ".$e->getMessage());
}
$requete="SELECT * FROM QUESTION WHERE id_questionnaire ={$_GET["id_questionnaire"]}";
$resultat=$sgbd->query($requete);


if($resultat==false)
	exit("erreur PDO:query($requete)");

$fini=false;
while(!$fini){
	$questions=$resultat->fetchObject();
	if($questions==false){
		$fini=true;
	}else{
		echo "<li>"."<a href=\"formulaire1.php?id_questionnaire=".$questions -> id_questionnaire."&id_question=".$questions -> id_question."\">"."Question ".$questions -> id_question."</a>"." :\"".$questions -> texte."\"</li>";
	}
}
?>
