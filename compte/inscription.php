<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/inscription.css" rel="stylesheet" type="text/css">
</head>

<body>


    <?php
    session_start();
    if (!empty($_SESSION['teacher']))
        header('Location: ../menu/menu.php');

    include('../includes/barreInvite.php');
    include('../includes/connectBase.php');
    ?>
    <div id="container2">

        <fORM method="post" action="valideInscription.php">
            <h1>Créer votre compte</h1>

            <!-- Cases pour ecrire -->
            <br>
            Nom : *
            <br>
            <input type="text" id="username" name="username" size="20" required>
            <br>
            Adresse mail: *
            <br>
            <input type="email" id="mail" name="mail" size="20" required>
            <br>
            Mot de passe: *
            <br>
            <input type="password" id="motDePasse" name="motDePasse" size="20" required>
            <br>
            Vérification du mot de passe: *
            <br>
            <input type="password" id="motDePasse2" name="motDePasse2" size="20" required>
            <br>

            <?php
            //vérification des erreurs
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur les mots de passe ne sont pas identiques
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 2) {
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
            <!-- Bouton pour valider -->
            <input type="submit" value="Valider">

        </FORM>
    </div>
</body>

</html>