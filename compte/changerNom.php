<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/changerNom.css" rel="stylesheet" type="text/css">
</head>

<body>


    <?php
    include('../Classes/includeClass.php');
    session_start();
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        header('Location: ../menu/menu.php');
    include('../includes/connectBase.php');

    ?>
    <div id="container2">

        <fORM action="validationNom.php" method="post">
            <h1>Changer vos informations</h1>

            <!-- Cases pour ecrire -->
            <br>
            Nom : *
            <br>
            <input type="text" id="username" name="username" size="20" value="<?php echo $_SESSION['teacher']->getLogin() ?>" required>
            <br>
            <br>
            Adresse mail: *
            <br>
            <input type="email" id="mail" name="mail" size="20" value="<?php echo $_SESSION['teacher']->getMail() ?>" required>
            <br>


            <?php
            //vérification des erreurs
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 2) {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur le nom est déjà utilisé
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 3) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur veuillez réessayer plus tard
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 4) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur le mail est déjà utilisé
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

            <br>
            <!-- Bouton pour valider -->
            <input type="submit" value="Valider">

        </FORM>
    </div>
</body>

</html>