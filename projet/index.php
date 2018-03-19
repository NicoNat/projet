<?php

session_start();

$_SESSION['login'] = 'invalide';
$_SESSION['password'] = 'invalide';
$_SESSION['id'] = 0;
$_SESSION['erreurId'] = 0;
$_SESSION['compteCree'] = 0;
$_SESSION['question'] = 0;
$_SESSION['questiontotal'] = 0;
$_SESSION['texte'] = 'vide';


$_SESSION['reponse1'] = 'vide';
$_SESSION['reponse2'] = 'vide';

?>

<!DOCTYPE html>

<?php
$id="crepinl";
$mdp="1108010387S";
$nsd="mysql:host=webinfo.iutmontp.univ-montp2.fr;dbname=crepinl;charset=UTF8";
try
{
	$bdd = new PDO($nsd,$id,$mdp);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>BDD</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
		<div id="header">
			<h1>Login Elève Projet</h1>
			<h2>AS - IUT Montpellier</h2>
		</div>
		<form action="autentification.php" method="POST">
			<div class="group">
				<input type="text" name="login">
				<label>Login </label>
			</div>
			<div class="group">
				<input type="text" name="password">
				<label>Password </label>
			</div>
			<p><input class="login buttonBlue" type="submit"></p>
		</form>
		
		<p><?php
			if($_SESSION['erreurId'] == 1)
			{
				echo 'Mot de passe incorrect.';
			}
			if($_SESSION['compteCree'] == 1)
			{
				echo 'Compte créé, vous pouvez vous connecter';
			}
		?></p>
		 <footer><a href="https://material.io/guidelines/" target="_blank"><img src="ressources/material.png"></a>
		<p>Google <a href="https://material.io/guidelines/" target="_blank">Material Design</a></p>
		<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="js/scripts.js"></script>
    </body>
</html>
