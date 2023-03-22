<?php
include '../Classes/includeClass.php';
session_cache_limiter('private_no_expire, must-revalidate');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Resultat de la recherche</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/resultatRecherche.css" rel="stylesheet" type="text/css">
</head>

<body>
<?php if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        include('../includes/barreInvite.php');?>
        
    <form action="./RechercherUneListe.php" method="post">
        <p id="back"><input type="submit" value="Retour"></p>
    </form>
    <?php if (!empty($_SESSION['array'])) { ?>
        <table border="1" CELLPADDING="10" class="tableau">
            <tr>
                <th colspan="3">Resultat de la recherche</th>
            </tr>
            <td> Nom de la liste</td>
            <td> Niveau de la liste </td>
            <?php
            $arr = $_SESSION['array'];
            foreach ($arr as $row) { ?>
                <tr>
                    <td> <?php echo $row->getNom(); ?> </td>
                    <td> <?php echo $row->getNiveau(); ?> </td>
                    <td>
                        <form action="./StudentOrTeacher.php?liste=<?php echo $row->getId(); ?>" method="post">
                            <p><input type="submit" value="Afficher la liste"></p>
                        </form>
                    </td>
                </tr>
            <?php }
            unset($_SESSION['array']);
            ?>
        </table>
    <?php } else { ?>
        <p> Aucune liste ne correpond à votre recherche </p>
    <?php } ?>

</body>