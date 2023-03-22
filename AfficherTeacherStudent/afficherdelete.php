<?php
include '../includes/head.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ModifierListe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

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

        <?php
        $logteacher = $teacher->getLogin();
        $createur = $teacher->créateurListe($liste);

        //Si je suis différent et que je ne suis pas l'admin
        if (($createur != $logteacher) && (empty($_SESSION['admin']))) {

            header('Location: afficherTeacher.php?liste=' . $liste);
        } ?>


        <br>
        <div class="container" align="center">
            <div id="bloc">
                <FONT face="Courier, monospace">
                    <h1 style="text-align:center;">La liste de mot à modifier :</h1>


                    <div class="table-responsive" id="tableau">
                        <table border="1" CELLPADDING="10" class="table table-striped">
                            <tr class="table-primary">
                                <td style="text-align:center;">Mot</td>
                                <td style="text-align:center;">Image</td>
                                <td style="text-align:center;">Son</td>
                                <td style="text-align:center;">Modifier</td>
                            </tr>

                            <?php

                            $cpt = 1;
                            while ($cpt <= count($listecomplete)) {

                            ?>
                                <tr class="table-primary">
                                    <td style="text-align:center; vertical-align:middle;" class="table-primary">
                                        <?php

                                        echo $listecomplete[$cpt]->Nom;
                                        $motcour = $listecomplete[$cpt]->Nom;
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
                                    <td style="text-align:center; vertical-align:middle;" class="table-primary">
                                        <a class="link-danger" href="modification.php?liste=<?php echo $liste; ?>&motcour=<?php echo $listecomplete[$cpt]->Nom; ?>">Supprimer</a>
                                    </td>
                                </tr>
                            <?php
                                $cpt++;
                            }
                            ?>

                            <tr>

                                <form action="AjouterModif.php?liste=<?php echo $liste ?>" method="post" enctype="multipart/form-data">
                                    <td>nom : <input type="text" name="nom" required /></td>
                                    <td>image : <input type="file" name="image" /></td>
                                    <td>musique : <input type="file" name="musique" /></td>
                                    <td><input name=upload type="submit" value="Ajouter"></td>

                                </form>

                            </tr>
                        </table>


                        <?php if (isset($_GET['err'])) {
                            $err = $_GET['err'];
                            if ($err == 1) {
                                echo '<h5> Erreur: Veuillez remplir les champs Image ou Son avec un fichier correcte ! </h5>';
                            } else if ($err == 2) {
                                echo '<h5> Erreur: Veuillez remplir le champ Image avec un fichier correcte ! </h5>';
                            } else if ($err == 3) {
                                echo '<h5> Erreur: Veuillez remplir le champ Son avec un fichier correcte ! </h5>';
                            }
                        }
                        ?>
                    </div>
                    <br>

                    <form action="../dictee/debut.php?liste=<?php echo $liste ?>" method="post" TARGET=_BLANK>
                        <input type="hidden" disabled="disabled" name="compteur" id="compteur" value=<?php $liste ?>>

                        <button type="submit" name="valider" id="valider" class="btn btn-primary" TARGET=_BLANK>Commencer la dictée</button>
                    </form>

                    <form action="afficherTeacher.php?liste=<?php echo $liste ?>" method="post">
                        <input type="hidden" name="compteur" id="compteur" value=>
                        <button type="submit" name="valider" id="valider" class="btn btn-primary">Affichage</button>
                    </form>

                    <br>
                    <br>

                    <div id="wrapper">
                        <input class="form-control" type="text" value="http://localhost/GIT/projet-citrouille/AfficherTeacherStudent/AfficherStudent.php?liste=<?php echo $liste ?>">
                        <button class="btn btn-dark">Copier</button>
                        <script src="../includes/copier.js" async></script>
                    </div>

                    <br>

                <?php
            }
                ?>
            </div>
        </div>
        <br>
        <br>

</body>

</html>