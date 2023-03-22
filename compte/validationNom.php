<!DOCTYPE html>
<html>

<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
</head>

<body>


    <?php
    include('../Classes/includeClass.php');
    session_start();
    if (empty($_SESSION['teacher']))
        header('Location: ../menu/menu.php');
    include('../includes/connectBase.php'); ?>

    <h1>Changement de vos données</h1>

    <?php
    if ((isset($_POST['username'])) && (isset($_POST['mail']))) {
        $mail = $_POST['mail'];
        $usernam = $_POST['username'];
        $teacher = $_SESSION['teacher'];

        $destination = $teacher->CompteLibre($mail, $usernam);

        //verifier que l'username est deja pris

        if (strcmp(gettype($direction), "integer") == 0) {
            if ($destination == 3) {
                header('Location: changerNom.php?erreur=3');
                exit;
            }
            if ($destination == 2) {
                header('Location: changerNom.php?erreur=2');
                exit;
            }
            if ($destination == 4) {
                header('Location: changerNom.php?erreur=4');
                exit;
            }
        }
        $_SESSION['teacher']->setLogin($usernam);
        $_SESSION['teacher']->setMail($mail);
        header('Location: compte.php');
    }
    ?>


</body>

</html>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>