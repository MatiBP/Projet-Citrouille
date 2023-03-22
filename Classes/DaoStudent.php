<?php
class DaoStudent
{
    //je comprends pas trop le role de la fonction
    public function rentrerUnMot(Mot $mot, Liste $liste, int $id)
    {
        include 'connectBase.php';
        $sql =  "SELECT * FROM `$liste` WHERE $liste AND id = $id AND mot = $mot"; //cherche le mot dans bdd
        $result = $conn->query($sql);
        if (!$result) { //si mot pas present
            echo "<img src= 'image/cocheverte.png' class ='photo'>";
        } else {
            echo "<img src= 'image/croixrouge.png' class ='photo'>";
        }
    }
}
?>