<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/menu.css" rel="stylesheet" type="text/css">

</head>

<body>

    <?php
    include '../Classes/includeClass.php';
    session_start();
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        include('../includes/barreInvite.php');
    include('../includes/connectBase.php');

    ?>
    <div id="container2">
        <div id="bloc">
            <h1> Bienvenue sur le site Citrouille ! </h1>

            <p> Le principe du site est de faire une dictée en s'amusant.
                Un utilisateur peut ajouter sa propre liste de mots contenant des images et/ou des sons.
                Puis il récupère un lien à partager pour faire la dictée.
                Les enfants peuvent s'entrainer en faisant la dictée tout en s'amusant grâce aux images et aux sons.
            </p>
        </div>
    </div>
</body>

</html>