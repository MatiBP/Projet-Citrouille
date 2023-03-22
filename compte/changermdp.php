<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/changermdp.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php
    session_start();
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        header('Location: ../menu/menu.php');
    include('../includes/connectBase.php'); ?>

    <div id="container2">
        <fORM action="validationmdp.php" method="post">
            <h1>Changer votre mot de passe</h1>

            <!-- Cases pour ecrire -->
            <br>
            Votre ancien mot de passe:*
            <br>
            <input type="password" id="old" name="old" size="20" required>
            <br>
            <br>
            Votre nouveau mot de passe:*
            <br>
            <input type="password" id="new" name="new" size="20" required>
            <br>
            <br>
            Vérification du nouveau mot de passe:*
            <br>
            <input type="password" id="new2" name="new2" size="20" required>
            <br>

            <?php
            //vérification des erreurs
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur de connexion, réessayer plus tard
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 2) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        L'ancien mot de passe est erroné
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 3) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Les nouveaux mots de passe ne sont pas identiques
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur
                    </div>
            <?php
                }
            }

            ?>

            <!-- Bouton pour valider -->
            <input type="submit" value="Valider">

        </FORM>
    </div>

</body>

</html>