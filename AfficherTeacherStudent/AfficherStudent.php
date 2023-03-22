<?php
include '../includes/head.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php
    if (isset(($_GET['liste']))) {
        $_SESSION['liste'] = $_GET['liste'];

        $liste = $_SESSION["liste"];
        $teacher = new teacher(0, "", "", "");

        $listeNum = intval($liste);

        $listecomplete = $teacher->rechercherListeNumero($listeNum);
    ?>
        <br>
        <div class="container" align="center">
            <div id="bloc">
                <FONT face="Courier, monospace">
                    <h1 style="text-align:center;">La liste de mot à apprendre :</h1>

                    <div class="table-responsive" id="tableau">
                        <table border="1" CELLPADDING="10" class="table">
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

                                        echo '<img src=" ../' . $listecomplete[$cpt]->Image . ' "class="bd-placeholder-img rounded mx-auto d-block" width="500" width="500"  xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 200x200" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#868e96"></rect>';

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

                    <form action="../dictee/debut.php?liste=<?php echo $liste ?>" method="post">
                        <input type="hidden" disabled="disabled" name="compteur" id="compteur" value=<?php $liste ?>>
                        <button type="submit" name="valider" id="valider" class="btn btn-primary btn-lg">Commencer la dictée</button>
                    </form>
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