<!DOCTYPE html>
<html>

<head>
    <title>Dictee</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/dictee.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Pacifico" />
    <?php include('../includes/connectBase.php');
    session_cache_limiter('private_no_expire, must-revalidate');
    session_start();

    ?>

</head>

<body>

    <div class="haut">
        <h1>Devine le mot</h1>
        <p class='nbrquestion'><?php echo "Question " . ($_SESSION["compteur"] + 1) . " sur " . $_SESSION['max']  ?></p>
    </div>



    <?php
    //affiche photo et son
    echo "<div class='centre'>";

    if ($_SESSION['imagedictee'] != NULL) {
        echo "<img src=../" . $_SESSION['imagedictee'] . " class ='photo'>";
    }
    echo nl2br("\n");
    if ($_SESSION['sondictee'] != NULL) {
    ?>
        <audio controls='controls' class='son'>
            <source src='../<?php echo $_SESSION['sondictee']; ?>' />
        </audio>

    <?php
    }
    ?>

    </div>



    <form action="valideDictee.php?" method="post" id="monformulaire" name="monformulaire">
        <div class="bas">
            <div class="basgauche">

                <img src="../image/gomme.png" onclick="window.document.monformulaire.reset()" class='gomme'>
            </div>
            <div class="bascentre">
                <input type="text" name="reponse" id="reponse" class=" reponse" placeholder="Entre le mot ici !" maxlength="20" required autocomplete="off">
            </div>
            <div class="basdroite">
                <input type="image" name="valider" id="valider" class="valider" src="../image/coche.png">
            </div>
        </div>
    </form>

    </div>

    <br>
</body>

</html>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>