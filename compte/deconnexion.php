<!DOCTYPE html>
<html>
    <head>
        <title>citrouille</title>
        <meta charset="utf-8">
        <link href="styles/style.css" rel="stylesheet" type="text/css">
    </head>

    <body>

        <?php 
            session_start();
            // Suppression des variables de session et de la session
            $_SESSION = array();
            session_destroy();

            // Suppression des cookies de connexion automatique
            setcookie('login', '');
            setcookie('pass_hache', '');

            //redirection sur la page de connexion
            header('Location: connexion.php');
        ?>
         
    </body>
</html>