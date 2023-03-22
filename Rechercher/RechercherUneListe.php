<?php
session_cache_limiter('private_no_expire, must-revalidate');
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Resultat de la recherche</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/recherche.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        include('../includes/barreInvite.php');
    ?>
    <div id="box">
        <h1>Rechercher une liste</h1>
            <form action="ChercheMot.php" method="post">
                <p>Nom de la liste: <input type="text" name="nomRecherche"> <input type="submit" value="OK"></p>
            </form>
            <form action="ChercheMot.php" method="post">
                <p>Mot dans la liste: <input type="text" name="motRecherche"> <input type="submit" value="OK"></p>
            </form>
            <form action="ChercheMot.php" method="post">
                <p>Niveau de la liste:
                    <input type="submit" value="CP" name="niveau">
                    <input type="submit" value="CE1" name="niveau">
                    <input type="submit" value="CE2" name="niveau">
                    <input type="submit" value="CM1" name="niveau">
                    <input type="submit" value="CM2" name="niveau">
                    <input type="submit" value="Autre" name="niveau">
                </p>
            </form>
    </div>

</body>

</html>