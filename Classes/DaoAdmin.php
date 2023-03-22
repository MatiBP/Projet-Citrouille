<?php
class DaoAdmin
{

    public function modifierMdp(String $loging, String $NewMdp)
    {
        include 'connectBase.php';
        $hash = password_hash($NewMdp, PASSWORD_DEFAULT);
        if (empty($loging)) {
            echo "Pas de loging";
        }
        $sql = 'UPDATE user SET `password` = "' . $hash . '"
        WHERE username = "' . $loging . '"';
        $stmt = $conn->query($sql);
        if (!$stmt) {
            echo "Error modifier passeword";
            exit();
        } else {
            echo "passeword changed";
        }
    }

    public function modifierLoging(String $loging, String $NewLoging)
    {
        include 'connectBase.php';

        if (empty($loging)) {
            echo "Pas de loging";
        }
        $sql = 'UPDATE user SET username = "' . $NewLoging . '"
        WHERE username = "' . $loging . '"';
        $stmt = $conn->query($sql);
        if (!$stmt) {
            echo "Error modifier loging";
            exit();
        } else {
            echo "loging changed";
        }
    }

    public function modifierDroit(String $loging, int $droit)
    {
        include 'connectBase.php';

        if (empty($loging)) {
            echo "Pas de loging";
        }
        $sql = 'UPDATE user SET admin = "' . $droit . '"
        WHERE username = "' . $loging . '"';
        $stmt = $conn->query($sql);
        if (!$stmt) {
            echo "Error modifier droit";
            exit();
        } else {
            echo "droit changé";
        }
    }

    public function RecuperProfils()
    {
        include '../includes/connectBase.php';
        $sql =  'SELECT * FROM `user`';
        $result = $conn->query($sql);
        $login = array();
        $mail = array();
        $admin = array();
        $cpt = 0;
        foreach ($result as $result) {
            $cpt++;
            $login[$cpt] = $result['username'];
            $mail[$cpt] = $result['mail'];
            $admin[$cpt] = $result['admin'];
        }
        $profils = array(1 => $login, 2 => $mail, 3 => $admin);
        return $profils;
    }
}
