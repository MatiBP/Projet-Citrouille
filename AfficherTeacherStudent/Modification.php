<?php
include '../includes/head.php';
session_start();
?>

<?php
if (isset($_GET['motcour']) && isset($_GET['liste'])) {
   $teacher = $_SESSION['teacher'];
   $liste = $_GET['liste'];
   $mot = $_GET['motcour'];
   $newliste = new Liste($liste, '', '');

   $res =  $newliste->ChercherMot($mot);
   $newliste->supprimerMot($res);

   if ($newliste->LastId() == 0) {
      $teacher->SupprimerListe($liste);
      header("Location: ../menu/menu.php");
      exit;
   }
}

header('Location: afficherdelete.php?liste=' . $liste);


?>

<SCRIPT LANGUAGE="JavaScript">
   //bloque le retour sur cette page 
   history.forward()
</SCRIPT>