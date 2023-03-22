<?php
include '../includes/head.php';
session_start();



?>
<?php
$liste = $_GET['liste'];




$imerror = $_FILES["image"]["error"];
$sonerror = $_FILES["musique"]["error"];
if (!empty($_POST["nom"]) &&  (((!($imerror == 4)) || (!($sonerror == 4))))) {

    $mot = "$_POST[nom]";
    $image = $_FILES["image"]["name"];
    $son = $_FILES["musique"]["name"];
    $name = explode('.', $image);
    $ext = end($name);
    $name2 = explode('.', $son);
    $ext2 = end($name2);
    echo "?";
    echo $ext;
    echo "?";
    echo $ext2;
    echo "?";
    if (!($ext=="jpg"||$ext=="jpeg"||$ext=="png"||$ext=="pdf"||$ext=="")&&!($ext2=="mp3"||$ext2=="wav"||$ext2=="")){
        echo "Erreur Fichier image + Fichier son ";
        header('Location: afficherdelete.php?err=1&liste=' . $liste);
       }
   else if (!($ext=="jpg"||$ext=="jpeg"||$ext=="png"||$ext=="pdf"||$ext=="")){
    echo "Erreur Fichier image ";
    header('Location: afficherdelete.php?err=2&liste=' . $liste);
   }
   else if(!($ext2=="mp3"||$ext2=="wav"||$ext2=="")){
    echo "Erreur Fichier musique ";
    header('Location: afficherdelete.php?err=3&liste=' . $liste);
   }


    $fileimage = $_FILES["image"];
    $filemusique = $_FILES["musique"];

    $newliste = new Liste($liste, '', '');
    echo "listes/" . $image;
    echo $newliste->LastId();








    $idcourant = $newliste->LastId() + 1;
    $var = "listes/" . $liste . "/" . $idcourant . "." . $ext;
    $var2 = "listes/" . $liste . "/" . $idcourant . "." . $ext2;
    $newmot = new Mot($idcourant, $mot, $var, $var2);

    $newliste->ajouterMot($newmot);
    $newliste->EnregistrerMot($fileimage, $filemusique, $newmot->id);
    header('Location: afficherdelete.php?liste=' . $liste);
} else {

    header('Location: afficherdelete.php?err=1&liste=' . $liste);
}
header('Location: afficherdelete.php?liste=' . $liste);

?>