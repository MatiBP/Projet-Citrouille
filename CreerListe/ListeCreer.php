<?php
session_start();
if (empty($_SESSION['teacher'])) {
    header('Location: ../compte/connexion.php');
    exit;
}
include '../includes/head.php';
?>

<!DOCTYPE html>
<html lang="en">



<body>
    <?php
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        include('../includes/barreInvite.php'); ?>
    <br>
    <div class="container">
        <div id="bloc">
            Votre liste à bien été créée <br><br>
            <form action="../menu/menu.php" method="post">
                <input type="submit" name="retour" id="retour" value="Retour au menu">
            </form>
        </div>
    </div>

</body>