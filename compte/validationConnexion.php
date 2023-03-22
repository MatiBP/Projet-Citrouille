<?php
include('../includes/connectBase.php');
include('../Classes/includeClass.php');
session_start();
if (!empty($_SESSION['username']))
    header('Location: ../menu/menu.php');




if ((isset($_POST['username'])) && (isset($_POST['motDePasse']))) {
    $username = $_POST['username'];
    $motDePasse = $_POST['motDePasse'];
    //recupération des données sur le compte
    $teacher = new Teacher(-1, "", "", "");
    $direction = $teacher->Valider($username, $motDePasse);

    if (strcmp(gettype($direction), "integer") == 0) {
        if ($direction == 1) {
            header('Location: connexion.php?erreur=1');
            exit;
        }
        if (gettype($direction == 2)) {
            header('Location: connexion.php?erreur=2');
            exit;
        }
        if ($direction == 3) {
            header('Location: connexion.php?erreur=3');
        }
    }
    if (strcmp(gettype($direction), "array") == 0) {
        $_SESSION['teacher'] = $direction[2];
        $_SESSION['admin'] = $direction[1];
        header('Location: ../menu/menu.php');
        exit;
    } else {
        $_SESSION['teacher'] = $direction;
        header('Location: ../menu/menu.php');
        exit;
    }
}
?>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>