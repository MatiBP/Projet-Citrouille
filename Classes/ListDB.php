<?php
class ListDB
{


    public function ajouterMot(Mot $NewMot, int $id)
    {
        include 'connectBase.php';
        $req = $conn->prepare('INSERT INTO `' . $id . '` (`numero`,`numeroListe`, `mot`, `image`, `son` )
        VALUES("' . $NewMot->getId() . '", "' . $id .  '", "' . $NewMot->getNom() . '", "' . $NewMot->getImage() . '", "' . $NewMot->getSon() . '")');
        $req->execute();
    }

    public function supprimerMot(Mot $DelMot, int $id, int $lastId)
    {
        include 'connectBase.php';
        $sql =  'DELETE FROM `' . $id . '` WHERE numero = ' . $DelMot->getId() . '';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error supprimerMot1";
            exit;
        }
        $sql = 'UPDATE `' . $id . '` SET numero = (numero-1) WHERE numero > ' . $DelMot->getId();
        $result = $conn->query($sql) or die(print_r($conn->errorInfo()));

        $i = $DelMot->getId();
        while ($i <= $lastId - 1) {
            echo $i . '<br>';
            $moot = $this->ChercherMotNum($i, $id);

            $imag = $moot->getImage();
            if (strcmp($imag, "") != 0) {
                $name = explode('.', $imag);
                $imag = end($name);
            }
            if (strcmp($imag, "") != 0) {
                $lienImg = 'listes/' . $id . '/' . $i . '.jpg';
            } else {
                $lienImg = 'listes/' . $id . '/' . $i . '.';
            }
            $sql = 'UPDATE `' . $id . '` SET image = "' . $lienImg . '" WHERE numero =' . $i;
            $result = $conn->query($sql); // or die(print_r($conn->errorInfo()));
            if (!$result) {
                echo 'erreurBDD';
            }
            $song = $moot->getSon();
            if (strcmp($song, "") != 0) {
                $name = explode('.', $song);
                $song = end($name);
            }
            if (strcmp($song, "") != 0) {
                $lienSon = 'listes/' . $id . '/' . $i . '.mp3';
            } else {
                $lienSon = 'listes/' . $id . '/' . $i . '.';
            }
            $sql = 'UPDATE `' . $id . '` SET son = "' . $lienSon . '" WHERE numero =' . $i;
            $result = $conn->query($sql); //or die(print_r($conn->errorInfo()));
            if (!$result) {
                echo 'erreurBDD';
            }


            $i++;
        }
    }

    public function ChercherMot(String $Mot, int $id)
    {
        include 'connectBase.php';

        $sql =  'SELECT * FROM `' . $id . '` WHERE mot = "' . $Mot . '"';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error ChercherMot";
            exit;
        } else {
            foreach ($result as $result) {
                $res = new Mot($result['numero'], $result['mot'], $result['image'], $result['son']);
            }
        }
        return $res;
    }

    public function ChercherMotNum(int $numero, int $id)
    {
        include 'connectBase.php';

        $sql =  'SELECT * FROM `' . $id . '` WHERE numero = "' . $numero . '" AND numeroListe = "' . $id . '"';
        $result = $conn->query($sql);

        if (!$result) {
            echo "Error ChercherMotNum";
            exit;
        } else {
            foreach ($result as $result) {
                if (!$result['son'])
                    $res = new Mot($result['numero'], $result['mot'], $result['image'], "");
                else {
                    $res = new Mot($result['numero'], $result['mot'], $result['image'], $result['son']);
                }
            }
        }
        return $res;
    }

    public function maxRow(String $liste)
    {
        include 'connectBase.php';

        $sql =  "SELECT * FROM `$liste` WHERE $liste";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error pas de liste";
            exit;
        } else {
            $max = 0;
            foreach ($result as $row) {
                $max++;
            }
            $_SESSION['max'] = $max;

            $_SESSION['ordre'] = range(1, 3);


            foreach ($_SESSION['ordre'] as $number) {
            }
            return $max;
        }
    }
    public function LastId(Int $id)
    {
        include 'connectBase.php';

        $sql =  'SELECT * FROM `' . $id . '`';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error LastId()";
            exit;
        } else {
            return $result->rowCount();
        }
    }
}
