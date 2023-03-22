<?php

session_cache_limiter('private_no_expire, must-revalidate');
session_start();

$compteur = $_SESSION["compteur"];
$tableau = $_SESSION['tableau'];
$numbers = $_SESSION['numbers'];
$tableauReponse = $_SESSION["tableauReponse"];

if (isset(($_POST['reponse']))) {
    //tableau contenant les réponse de l'utilisateur ainsi que les vrai réponse
    //vrai réponse
    $tableauReponse[$compteur][0] = $tableau[$numbers[$compteur]]["mot"];
    //réponse utilisateur
    $tableauReponse[$compteur][1] = $_POST['reponse'];
    $_SESSION["tableauReponse"] = $tableauReponse;
}

$_SESSION["compteur"] = $_SESSION["compteur"] + 1;
$compteur = $_SESSION["compteur"];

//si tous les mots sont passsés, dirige vers la page des résultats
if ($compteur >= $_SESSION["max"]) {
    header('Location: fin.php');
    exit;
}

//récupère l'image et son du mot suivant
if (($tableau[$numbers[$compteur]]['image'] != NULL) && ($tableau[$numbers[$compteur]]['son'] != '')) {
    $_SESSION['imagedictee'] = $tableau[$numbers[$compteur]]['image'];
} else {
    $_SESSION['imagedictee'] = NULL;
}

if (($tableau[$numbers[$compteur]]['son'] != 'NULL') && ($tableau[$numbers[$compteur]]['son'] != '')) {
    $_SESSION['sondictee'] = $tableau[$numbers[$compteur]]['son'];
} else {
    $_SESSION['sondictee'] = NULL;
}

header('Location: dictee.php');
?>


<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>