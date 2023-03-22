<?php
include '../Classes/includeClass.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: ../compte/connexion.php');
}
$login = $_POST['login'];
$NewMdp = $_POST['NewMdp'];


$admin = $_SESSION['admin'];
$admin->modifierMdp($login, $NewMdp);
header('Location: ModerationCompte.php?valide=1&id=' . $login);
