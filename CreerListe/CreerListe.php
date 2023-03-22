<!DOCTYPE html>
<html lang="en">


<head>
    <title>CreerListe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/CreerListe.css" rel="stylesheet" type="text/css">

</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['admin']))
        include '../includes/barreAdmin.php';
    elseif (!empty($_SESSION['teacher']))
        include('../includes/barreConnecte.php');
    else
        header('Location: ../menu/menu.php');
    ?>

    <div id="container2">
        <form action="Creerlist.php?" method="post" enctype="multipart/form-data">
            <h1>Créer une liste</h1>
            <h2>Ecrire le nom de la liste</h2>
            <input required type="text" name="List" id="List">
            <br>
            <br>
            <h2>Inserer un zip contenant la liste</h2>
            <input required type="file" name="file">

            <div class="spoiler" onclick="ouvrirFermerSpoiler(this);">
                IMPORTANT : CLIQUER ICI POUR ACCEDER AU TUTORIEL
                <div class="contenuSpoiler">
                    Le fichier .zip doit contenir un fichier .txt sous cette forme :
                    <br>
                    <img src="../image/exempleListe.jpg">
                    <br>
                    ATTENTION : le txt doit être exactement au bon format ! cela peut engendrer une réinstallation du site si jamais le format n'est pas respecté.
                    <br>
                    Dans le fichier .zip veuillez mettre les photos ainsi que les sons avec les bons noms et le bon format.
                </div>
            </div>
            <br>
            <h2>Définir le niveau de la liste</h2>
            <select name="niveau" id="niveau">
                <option value="CP">CP</option>
                <option value="CE1">CE1</option>
                <option value="CE2">CE2</option>
                <option value="CM1">CM1</option>
                <option value="CM2">CM2</option>
                <option value="autre">autre</option>
            </select>
            <br><br><br>
            <?php if (isset($_GET['err'])) {
                if ($_GET['err'] == 1) {
                    echo 'erreur : Verifier vos fichiers';
                }
                if ($_GET['err'] == 2) {
                    echo 'erreur : Votre fichier est trop volumineux';
                }
            } ?>
            <input type="submit" name="valider" id="valider" value="Créer la liste">
        </form>

    </div>
</body>


<script type="text/javascript">
    function ouvrirFermerSpoiler(div) {
        var divContenu = div.getElementsByTagName('div')[0];
        if (divContenu.style.display == 'none') {
            divContenu.style.display = 'block';
        } else {
            divContenu.style.display = 'none';
        }
    }
</script>