<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
<?php
include '../includes/head.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        header('Location: ../menu/menu.php');
    ?>

    <?php
    if (isset(($_GET['liste']))) {
        $_SESSION['liste'] = $_GET['liste'];

        $liste = $_SESSION["liste"];
        $teacher = $_SESSION['teacher'];

        $listeNum = intval($liste);

        $listecomplete = $teacher->rechercherListeNumero($listeNum);
    ?>
        <br>
        <div class="container" align="center">
            <div id="bloc">
                <FONT face="Courier, monospace">

                    <h1 style="text-align:center;">La liste de mot à apprendre :</h1>

                    <div class="table-responsive" id="tableau">
                        <table border="1" CELLPADDING="10" class="table table-striped">
                            <tr class="table-primary">
                                <td style="text-align:center;">Mot</td>
                                <td style="text-align:center;">Image</td>
                                <td style="text-align:center;">Son</td>
                            </tr>

                            <?php
                            $cpt = 1;
                            while ($cpt <= count($listecomplete)) {
                            ?>
                                <tr class=" table-primary">
                                    <td style="text-align:center; vertical-align:middle;" class=" table-primary">
                                        <?php

                                        echo $listecomplete[$cpt]->Nom;

                                        ?>
                                    </td>
                                    <td class="table-primary">
                                        <?php
                                        if (strcmp($listecomplete[$cpt]->Image, "listes/" . $listeNum . "/" . $cpt . ".") != 0) {

                                            echo '<img src=" ../' . $listecomplete[$cpt]->Image . ' "class="bd-placeholder-img rounded mx-auto d-block" width="500" height="auto" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect>';
                                        }
                                        ?>
                                    </td>
                                    <td style="vertical-align:middle;">
                                        <?php

                                        $song = "../" . $listecomplete[$cpt]->Son;

                                        ?>
                                        <audio controls="controls">
                                            <source src="<?php echo $song; ?>">
                                        </audio>
                                    </td>
                                </tr>
                            <?php
                                $cpt++;
                            }
                            ?>
                        </table>
                    </div>
                    <br>


                    <form action="../dictee/debut.php?liste=<?php echo $liste ?>" method="post" TARGET=_BLANK>
                        <input type="hidden" disabled="disabled" name="compteur" id="compteur" value=<?php $liste ?>>
                        <button type="submit" name="valider" id="valider" class="btn btn-primary">Commencer la dictée</button>
                    </form>




                    <?php
                    $logteacher = $teacher->getLogin();
                    $createur = $teacher->créateurListe($liste);

                    if (($createur == $logteacher)) {
                    ?>
                        <form action="afficherdelete.php?liste=<?php echo $liste ?>" method="post">
                            <input type="hidden" name="compteur" id="compteur" value=>
                            <button type="submit" name="valider" id="valider" class="btn btn-primary">Modifier</button>
                        </form>
                    <?php
                    } else if (!empty($_SESSION['admin'])) { ?>
                        <form action="afficherdelete.php?liste=<?php echo $liste ?>" method="post">
                            <input type="hidden" name="compteur" id="compteur">
                            <button class="button1" type="submit" name="valider" id="valider">Modifier</button>
                        </form>
                    <?php
                    } else {
                        echo "Pas de permission de modifier la liste car vous n'êtes pas le créateur";
                    } ?>


                    <br>
                    <br>

                    <div id="wrapper">
                        <input class="form-control" type="text" value="http://localhost/GIT/projet-citrouille/AfficherTeacherStudent/AfficherStudent.php?liste=<?php echo $liste ?>">
                        <button class="btn btn-dark">Copier</button>
                        <script src="../includes/copier.js" async></script>
                    </div>
                    <br>
            </div>
        </div>
    <?php
    }
    ?>
    <br><br>
    </FONT>
</body>

</html>