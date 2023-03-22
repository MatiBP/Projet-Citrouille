<?php
include '../Classes/includeClass.php';
session_start();
if ((empty($_SESSION['teacher'])))
    $teacher = new Teacher(0,"","","");
else
    $teacher = $_SESSION['teacher'];
if (!(empty($_POST['motRecherche']))) {
    $_SESSION['array'] = $teacher->rechercherListeMot($_POST['motRecherche']);
}
else if (!(empty($_POST['nomRecherche']))) {
    $_SESSION['array'] = $teacher->rechercherListe($_POST['nomRecherche']);
}
else if (!(empty($_POST['niveau']))) {
    $_SESSION['array'] = $teacher->rechercherListeNiveau($_POST['niveau']);
}
else {
    $_SESSION['array'] = $teacher->rechercherListeToutes();
}
header('Location: ./ResultatRecherche.php');
exit;
?>