<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/connexion.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['teacher']))
        header('Location: ../menu/menu.php');
    include('../includes/connectBase.php');
    include('../includes/barreInvite.php');
    ?>
    <div id="container2">
        
        <fORM method="post" action="validationConnexion.php">
            <h1>Connexion</h1>

            Nom:

            <input type="text" id="username" name="username" placeholder="Entrer le nom d'utilisateur" size="20" maxlength="40" required>

            Mot de passe:

            <input type="password" id="motDePasse" name="motDePasse" placeholder="Entrer le mot de passe" size="20" maxlength="20" required>
            <a href="mdpoublie.php">
                Mot de passe oublié ?
            </a>

            <br>


            <?php
            //Vérification des erreurs
            if (isset($_GET['erreur'])) {
                if ($_GET['erreur'] == 1) {
            ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur veuillez réessayer plus tard
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 2) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur mauvais nom ou mot de passe
                    </div>
                <?php
                } elseif ($_GET['erreur'] == 3) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Erreur mauvais nom ou mot de passe
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


            <input type="submit" value="Valider">

            <a href="inscription.php">
                <input type="button" value="Créer un compte">
            </a>

        </FORM>


    </div>


</body>

</html>