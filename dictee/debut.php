<?php 
include('../includes/connectBase.php');
session_cache_limiter('private_no_expire, must-revalidate');
session_start();

//Supprime la variable de session tableauReponse
unset($_SESSION["tableauReponse"]);

$_SESSION["compteur"] = 0;
$max = 0;

//Si une liste est bien prise en paramètre
if (isset(($_GET['liste']))) {
    $liste = $_GET['liste'];

    //requête pour récuperer toute la liste
    $sql =  "SELECT * FROM `$liste`";
    $result = $conn->query($sql);
    if (!$result) {
        //erreur si il n'y a rien
        //Envoyer sur une autre page ?
        echo "Erreur";
        exit;
    } else {
        //Tableau comprennant tous les mots
        foreach ($result as $row) {
            $tableau[$max]["numero"] = $row['numero'];
            $tableau[$max]["mot"] = $row['mot'];
            $tableau[$max]["image"] = $row['image'];
            $tableau[$max]["son"] = $row['son'];
            $max++;
        }

        //tableau pour savoir l'ordre de passage
        $numbers = range(0, $max - 1);
        shuffle($numbers);


        $_SESSION['numbers'] = $numbers;
        $_SESSION['max'] = $max;
        $_SESSION['tableau'] = $tableau;

        //Donne l'image et le son pour le premier mot
        if ($tableau[$numbers[0]]['image'] != NULL) {
            $_SESSION['imagedictee'] = $tableau[$numbers[0]]['image'];
        } else {
            $_SESSION['imagedictee'] = NULL;
        }

        if ($tableau[$numbers[0]]['son'] != NULL) {
            $_SESSION['sondictee'] = $tableau[$numbers[0]]['son'];
        } else {
            $_SESSION['sondictee'] = NULL;
        }

        if ($_SESSION["compteur"] >= $_SESSION["max"]) {
            header('Location: fin.php');
        } else {
            header('Location: dictee.php');
        }
    }
} else
    //erreur si aucune liste n'est en paramètre
    echo "Erreur aucune liste n'a été saisie"

?>

<SCRIPT LANGUAGE="JavaScript">
    //bloque le retour sur cette page 
    history.forward()
</SCRIPT>