<!DOCTYPE html>
<html>

<head>
    <title>Résultat</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/fin.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
    <?php include('../includes/connectBase.php');
    session_cache_limiter('private_no_expire, must-revalidate');
    session_start();
    ?>

</head>

<body>
    <div class="haut">
        <h1>Résultat de la dictée</h1>
    </div>


    <div class="centre">
        <table class="table-style">
            <thead>
                <tr>
                    <td>Ta réponse</td>
                    <td>La réponse attendue</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $compteur = 0;
                $note = 0;
                $reponse = $_SESSION["tableauReponse"];
                while ($compteur <= $_SESSION['max'] - 1) {
                ?>
                    <!-- tableau comparant les réponses -->
                    <tr>
                        <!-- réponse marqué par l'utilisateur -->
                        <td> <?php echo $reponse[$compteur][1]; ?> </td>
                        <!-- la correction -->
                        <td> <?php echo $reponse[$compteur][0]; ?> </td>
                        <!-- compare le mot sans prendre en compte les majuscules/minuscule et en retirant les espaces avant et après -->
                        <td> <?php if (strtolower(trim($reponse[$compteur][1])) == strtolower(trim($reponse[$compteur][0]))) {
                                    echo "<img src= '../image/cocheverte.png' class ='photo'>";
                                    $note++;
                                } else  echo "<img src= '../image/croixrouge.png' class ='photo'>"; ?>
                        </td>
                    </tr>
                <?php $compteur++;
                } ?>
            </tbody>
        </table>
        <!-- affiche la note -->
        <?php echo "<p class = resultat> La note finale est " . $note . " sur " . $_SESSION['max'] . "</p>"; ?>
            <a class="cta" href="../AfficherTeacherStudent/AfficherStudent.php?liste=<?php echo $_SESSION['liste'] ?>">
                <input type="button" value="Refaire la dictée">
                
            </a>

</body>

</html>