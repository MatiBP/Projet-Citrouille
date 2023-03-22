<?php
include('../Classes/includeClass.php');
session_start();
if (empty($_SESSION['teacher']))
    header('Location: ../menu/menu.php');
include('../includes/connectBase.php');

echo "<h1>Changement de vos données</h1>";

$teacher = $_SESSION['teacher'];

if ((isset($_POST['old'])) && (isset($_POST['new'])) && (isset($_POST['new2']))) {
    $old = $_POST['old'];
    $new = $_POST['new'];
    $new2 = $_POST['new2'];

    $direction =  $teacher->changermdp($old, $new, $new2);

    if (strcmp(gettype($direction), "integer") == 0) {
        if ($direction == 1) {

            header('Location: changermdp.php?erreur=1');
            exit;
        } else {

            if ($direction == 2) {

                header('Location: changermdp.php?erreur=2');
                exit;
            }
        }


        if ($direction == 3) {
            header('Location: changermdp.php?erreur=3');
            exit;
        }
    }

    header('Location: compte.php');
}
?>

</html>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>