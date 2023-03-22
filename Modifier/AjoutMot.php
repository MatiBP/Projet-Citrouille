<?php
include 'C:\wamp64\www\GIT\projet-citrouille/Classes/includeClass.php';

session_start();

if (empty($_SESSION['username'])) {
	header('Location: http://localhost/GIT/projet-citrouille/connexion.php');
	exit;
}


if (isset(($_POST['liste'])) && isset(($_POST['id'])) && isset(($_POST['Nom'])) && isset(($_POST['Image'])) && isset(($_POST['Son']))) {
    $mot = new Mot(($_POST['id']) , ($_POST['Nom']) , ($_FILES['Image']) , ($_FILES['Son']));
    		
	$liste = ($_POST['liste']);
    $liste->ajouterMotpublic($mot);
	
	
} else {
	echo 'Erreur ajout du mot';
}
 