<head>
    <title>Citrouille</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/moderationCompte.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php
    include('../Classes/includeClass.php');
    session_start();
    if (empty($_SESSION['admin'])) {
        header('Location: ../menu/menu.php');
    }
    if (empty($_SESSION['profils'])) {
        echo 'erreur de récupération de profils';
        exit;
    }
    include '../includes/barreAdmin.php';
    $profils = $_SESSION['profils'];
    $login = $profils[1];
    $mail = $profils[2];
    $admin = $profils[3];

    ?>

    <br>
    <div class="table-responsive" id="tableau">
        <table class="table table-striped">
            <thead>
                <tr>
                    <td>Login</td>
                    <td>mail</td>
                    <td>Actions</td>
                    <td>Administrateur</td>
                </tr>
            </thead>

            <?php
            $i = 1;
            while ($i <= count($login)) {

                //retire son comte du tableau
                if ($login[$i] == $_SESSION['teacher']->getLogin()) {
                    $i++;

                    if ($i > count($login)) {
                        exit;
                    }
                }
            ?>
                <tr>
                    <td>
                        <?php

                        echo $login[$i];


                        ?>
                    </td>
                    <td> <?php

                            echo $mail[$i];


                            ?> </td>
                    <td>
                        <form action="ModifLogin.php?" method="post">
                            <input type="text" name="NewLogin" id="NewLogin" required>
                            <input type="hidden" name="login" id="login" value="<?php echo $login[$i]; ?>">
                            <button class="button2" type="submit" name="valider" id="valider">Changer Login</button>
                        </form>
                        <br>
                        <form action="ModifMdp.php?" method="post">
                            <input type="password" name="NewMdp" id="NewMdp" required>
                            <input type="hidden" name="login" id="login" value="<?php echo $login[$i]; ?>">
                            <button class="button2" type="submit" name="valider" id="valider">Changer Mot de passe</button>
                        </form>
                        <?php if (!empty($_GET['valide']) && $_GET['id'] == $login[$i]) {
                            echo ' Mot de passe changé';
                        } ?>
                    </td>
                    <td>
                        <?php
                        if ($admin[$i] == 1) {
                            echo "<img src= '../image/coche.png' width='30' class ='photo' class='photo'>";
                            echo "<br>";
                            echo "<a href='ModifDroit.php?droit=0&login=" . $login[$i] . "'>Retirer les droits</a>";
                        } else {
                            echo "<img src= '../image/croixnoire.png' width='30' class ='photo'>";
                            echo "<br>";
                            echo "<a href='ModifDroit.php?droit=1&login=" . $login[$i] . "'>Ajouter les droits</a>";
                        }
                        ?>
                    </td>
                </tr>
            <?php $i++;
            }
            ?>
        </table>

    </div>
</body>