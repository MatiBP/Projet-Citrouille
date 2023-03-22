<?php
include '../Classes/includeClass.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: ../compte/connexion.php');
}
$login = $_POST['login'];
$NewLogin = $_POST['NewLogin'];

$admin = $_SESSION['admin'];
$admin->modifierLoging($login, $NewLogin);
$_SESSION['profils'] = $admin->RecuperProfils();
header('Location: ModerationCompte.php');
