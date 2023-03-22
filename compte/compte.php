<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/compte.css" rel="stylesheet" type="text/css">
</head>

<body>


    <?php
    include('../Classes/includeClass.php');
    session_start();

    if (empty($_SESSION['teacher']))
        header('Location: ../menu/menu.php');
    if (empty($_SESSION['admin'])) {
        include('../includes/barreConnecte.php');
    } else {
        include '../includes/barreAdmin.php';
    }
    include('../includes/connectBase.php'); ?>
    <div id="container2">
        <div id="bloc">
            <h1>Votre compte</h1>

            <br>
            <?php
            echo "Nom: " . $_SESSION['teacher']->getLogin();
            echo "<br>";
            echo "Adresse mail: " . $_SESSION['teacher']->getMail();
            echo "<br>";
            ?>

            <a href="changerNom.php">Modifier information</a>
            <br>
            <a href="changermdp.php">Modifier votre mot de passe</a>
            <!-- afficher ses listes -->
        </div>
    </div>
</body>

</html>