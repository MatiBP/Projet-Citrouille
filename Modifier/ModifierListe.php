<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php'; ?>

<body>
    <?php include '../includes/barreConnecte.php'; ?>

    <?php
    if (isset(($_GET['liste']))) {
        $_SESSION['liste'] = $_GET['liste'];

        $liste = $_SESSION["liste"];
        #$teacher = new Teacher("rumen", "1");

        $listeNum = intval($liste);

        $listecomplete = $teacher->rechercherListeNumero($listeNum);
        $max = 0;
        $max = $listecomplete->maxRow($liste);

        $_SESSION["compteur"] = 0;
    ?>

        <h1>Modifier La Liste:</h1>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

        <table border="1" cellpadding="10" class="tableau">
            <tr>
                <td>Mot</td>
                <td>Image</td>
                <td>Son</td>
                <td>Selection</td>
            </tr>

            <tr>
                <?php

                $compteur = $_SESSION["compteur"];

                while ($compteur <= $max - 1) {


                ?>
            <tr>
                <?php

                    $numero = $_SESSION["ordre"]["$compteur"];


                    $res =  $listecomplete->ChercherMotNum($numero);

                ?>
                <td>
                    <?php

                    if (!$res) {
                        echo "Pas de mot disponible";
                        exit;
                    } else {

                        echo $res->Nom;
                    }

                    ?>
                </td>
                <td> <?php

                        if (!$res) {
                            echo "Pas d'image disponible";
                            exit;
                        } else {
                            //echo $res->Image;
                            //echo '<img src=" ../listes/2/3.jpg  ">';
                            echo '<img src=" ../' . $res->Image . '  ">';
                        }


                        ?> </td>
                <td>
                    <?php

                    if (!$res) {
                        echo "Pas de Son disponible";
                        exit;
                    } else {

                        $song = "../" . $res->Son;
                    }

                    ?>
                    <audio controls="controls">
                        <source src="<?php echo $song; ?>">
                    </audio>

                </td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" />
                        <label class="form-check-label" for="defaultCheck1">
                            select
                        </label>
                    </div>
                </td>
            </tr>
        <?php $compteur++;
                }
        ?>

        </tr>
        </table>


        <form action="http://localhost/GIT/projet-citrouille/Modifier/AjoutMot.php?" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Id</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nom</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Image</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Son</span>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <button type="submit" class="btn btn-primary">Ajuter Mot</button>
        </form>

        <br>
        <form action="http://localhost/GIT/projet-citrouille/Modifier/SupMot.php?" method="post" enctype="multipart/form-data">

            <button type="submit" name="valider" id="valider" value="Supprimer Mot" class="btn btn-secondary">Supprimer Mot</button>

        </form>
        <br>
    <?php
    }

    ?>
    <br>
</body>

</html>