<?php
include '../Classes/includeClass.php';
session_start();
if (empty($_SESSION['admin'])) {
    header('Location: ../compte/connexion.php');
}
$admin = $_SESSION['admin'];
$_SESSION['profils'] = $admin->RecuperProfils();
header('Location: ModerationCompte.php');
