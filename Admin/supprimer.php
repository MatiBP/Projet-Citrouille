<?php
include '../Classes/includeClass.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: ../compte/connexion.php');
}
$login = $_GET['login'];

$admin = $_SESSION['admin'];

$admin->modifierDroit($login, $droit);
$_SESSION['profils'] = $admin->RecuperProfils();
header('Location: ModerationCompte.php');
