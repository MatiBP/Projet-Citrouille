<?php
include '../Classes/includeClass.php';

session_start();

if (empty($_SESSION['teacher'])) {
	header('Location: ../compte/connexion.php');
	exit;
}


if (isset(($_POST['List'])) && isset(($_POST['niveau'])) && isset($_FILES['file'])) {

	$file = $_FILES['file'];
	$name = explode('.', $file['name']);
	$ext = end($name);
	if ((strcmp($ext, "zip") != 0)) {
		header('Location: CreerListe.php?err=1');
		exit;
	}
	if ($file['size'] == 0) {
		header('Location: CreerListe.php?err=2');
		exit;
	}

	$teacher = $_SESSION['teacher'];
	$NewList = new Liste($teacher->LastId() + 1, $_POST['List'], $_POST['niveau']);
	$teacher->CreerListe($NewList);
	$err = $NewList->EnregistreListe($file);
	$destination = $NewList->txtToList();
	if ($destination == 1 || $err = 1) {
		header('Location: CreerListe.php?err=1');
		exit;
	};
	header('Location: CreerListe/ListeCreer.php');
	exit;
} else {
	header('Location: CreerListe.php?err=1');
	exit;
}
