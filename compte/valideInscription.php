<?php
include('../Classes/includeClass.php');
session_start();
if (!empty($_SESSION['teacher']))
    header('Location: ../menu/menu.php');

include('../includes/connectBase.php');

echo "<h1>Création du compte</h1>";

if ((isset($_POST['username'])) && (isset($_POST['mail'])) && (isset($_POST['motDePasse'])) && (isset($_POST['motDePasse2']))) {
    $usernam = $_POST['username'];
    $motDePasse = $_POST['motDePasse'];
    $motDePasse2 = $_POST['motDePasse2'];
    $mail = $_POST['mail'];
    $teacher = new Teacher(-1, "", "", "");
    $destination = $teacher->CreerCompte($usernam, $motDePasse, $motDePasse2, $mail);
    if (strcmp(gettype($destination), "integer") == 0) {
        if ($destination == 1) {
            header('Location: inscription.php?erreur=1');
            exit;
        }
        if ($destination == 3) {
            header('Location: inscription.php?erreur=3');
            exit;
        }
        if ($destination == 2) {
            header('Location: inscription.php?erreur=2');
            exit;
        }
        if ($destination == 4) {
            header('Location: inscription.php?erreur=4');
            exit;
        }
    }
    header('Location: connexion.php');
} else {
    echo "erreur, veuillez réssayer plus tard";
}

?>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>