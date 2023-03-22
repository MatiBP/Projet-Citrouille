
<?php

include 'ListDB.php';

class Liste
{
    public $id;
    public $Nom;
    public $niveau;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getNom()
    {
        return $this->Nom;
    }

    public function setNom(String $Nom)
    {
        $this->Nom = $Nom;
    }


    public function getNiveau()
    {
        return $this->niveau;
    }

    public function setNiveau(String $niveau)
    {
        $this->niveau = $niveau;
    }


    public function __construct(int $id, String $nom, String $niveau)
    {
        $this->id = $id;
        $this->Nom = $nom;
        $this->niveau = $niveau;
    }

    public function ajouterMot(Mot $NewMot)
    {
        $ListeDB = new ListDB;
        $ListeDB->ajouterMot($NewMot, $this->getId());
    }

    public function supprimerMot(Mot $DelMot)
    {


        $im = $DelMot->getImage();
        if (strcmp($im, "") != 0) {
            $name = explode('.', $DelMot->getImage());
            $im = end($name);
        }
        if (strcmp($im, "") != 0) {
            $DestImage = "../" . $DelMot->getImage();
            unlink($DestImage);
        }

        $son = $DelMot->getSon();
        if (strcmp($son, "") != 0) {
            $name = explode('.', $son);
            $son = end($name);
        }
        if (strcmp($son, "") != 0) {
            $DestSon = "../" . $DelMot->getSon();
            unlink($DestSon);
        }

        $destination = '../listes/' . $this->getId() . '/';

        $i = $DelMot->getId() + 1;
        while ($i <= $this->LastId()) {
            $moot = $this->ChercherMotNum($i);
            $imag = $moot->getImage();
            if (strcmp($imag, "") != 0) {
                $name = explode('.', $imag);
                $imag = end($name);
            }
            if (strcmp($imag, "") != 0) {
                rename($destination . $i . ".jpg", $destination . ($i - 1) . ".jpg");
            }



            $song = $moot->getSon();
            if (strcmp($song, "") != 0) {
                $name = explode('.', $song);
                $song = end($name);
            }
            if (strcmp($song, "") != 0) {
                rename($destination . $i . ".mp3", $destination . ($i - 1) . ".mp3");
            }
            $i++;
        }

        $ListeDB = new ListDB;
        $ListeDB->supprimerMot($DelMot, $this->getId(), $this->LastId());
    }

    public function ChercherMot(String $Mot)
    {
        $ListeDB = new ListDB;
        $res = $ListeDB->chercherMot($Mot, $this->getId());
        return $res;
    }


    public function ChercherMotNum(int $numero)
    {
        $ListeDB = new ListDB;
        $res = $ListeDB->ChercherMotNum($numero, $this->getId());
        return $res;
    }

    public function maxRow(string $liste)
    {
        $ListeDB = new ListDB;
        $res = $ListeDB->maxRow($liste);
        return $res;
    }

    public function EnregistreListe($file)
    {
        $name = explode('.', $file['name']);
        $ext = end($name);


        mkdir('../listes/' . $this->getId(), 0777);
        $destination = '../listes/' . $this->getId() . '/' . $file['name'];
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            $zip_file = $destination;
            $unzip_path = '../listes/' . $this->getId();
            $zip = new ZipArchive();
            if ($zip->open($zip_file) != true) {
                return 1;
            }

            $zip->extractTo($unzip_path);
            $zip->close();
            unlink($destination);
        }
    }

    /**
     * ajoute a la bdd les mots, les images et les son du txt stockés dans le dossier d'id de $this puis supprime le txt
     */
    public function txtToList()
    {
        $directoryPath = "../listes/" . $this->id;
        if (!$dir = opendir($directoryPath)) {
            return 1;
            exit;
        }
        $trouve = false;
        $cpt = 0;
        while (!$trouve && ($fichier = readdir($dir))) {
            $name = explode('.', $fichier);
            $ext = end($name);
            if (strcmp($ext, "txt") == 0) {
                $trouve = true;
                $txt = $fichier;
            }
        }
        $txtPath = "../listes/" . $this->id . "/" . $txt;
        $MyTxt = fopen($txtPath, "r");

        $fichier = false;
        while (!$fichier) {
            $cpt++;
            $nom = "";
            $image = "";
            $Son = "";
            $fini = false;

            $mot = new Mot($cpt, "", $cpt, $cpt);

            if ($cpt == 1) {
                $char = fgetc($MyTxt);
            }


            //Nom
            do {
                if ($char == ",") {
                    $fini = true;
                } else {
                    $nom = $nom . $char;
                }
            } while (!$fini && $char = fgetc($MyTxt));
            $mot->setNom($nom);
            $fini = false;
            //FinNom

            //Image
            while (!$fini && $char = fgetc($MyTxt)) {
                if ($char == ",") {
                    $fini = true;
                } else {
                    $image = $image . $char;
                }
            }
            $fini = false;
            $name = explode('.', $image);
            $ext = end($name);

            rename($directoryPath . "/" . $image, $directoryPath . "/" . $cpt . "." . $ext);
            $mot->setImage("listes/" . $this->id . "/" . $mot->getImage() . "." . $ext);
            //FinImage


            //Son
            $compteur = 0;
            while (!$fini && $char = fgetc($MyTxt)) {
                $compteur++;
                if ($char == "\n") {
                    $fini = true;
                } else {
                    $Son = $Son . $char;
                }
            }


            if ($compteur == 2) {
                $mot->setSon($Son);
            } else {
                $name = explode('.', $Son);
                $ext = end($name);
                rename($directoryPath . "/" . $Son, $directoryPath . "/" . $cpt . "." . $ext);
                $mot->setSon("listes/" . $this->id . "/" . $mot->getSon() . "." . $ext);
            }
            //FinSon

            $this->ajouterMot($mot);


            if (!$char = fgetc($MyTxt)) {
                $fichier = true;
            }
        }
        unlink($txtPath);
        return true;
    }

    public function LastId()
    {
        $listeDB = new ListDB();
        return $listeDB->LastId($this->getId());
    }

    public function EnregistrerMot($image, $son, $idMot)
    {
        //Image
        $directoryPath = "../listes/" . $this->getId();
        $destination = '../listes/' . $this->getId() . '/' . $image['name'];
        if (!move_uploaded_file($image['tmp_name'], $destination)) {
            echo 'erreur enregistreMot';
        }

        $name = explode('.', $image['name']);
        $ext = end($name);
        rename($directoryPath . "/" . $image['name'], $directoryPath . "/" . $idMot . "." . $ext);
        //FinImage

        //Son
        if (!empty($son)) {
            $destination = '../listes/' . $this->getId() . '/' . $son['name'];
            if (!move_uploaded_file($son['tmp_name'], $destination)) {
                echo 'erreur enregistreMot';
            }

            $name = explode('.', $son['name']);
            $ext = end($name);
            rename($directoryPath . "/" . $son['name'], $directoryPath . "/" . $idMot . "." . $ext);
        }
        //FinImage

    }
}




?>