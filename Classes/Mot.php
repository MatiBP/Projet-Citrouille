
<?php

class Mot
{
    public $id;
    public $Nom;
    public $Image;
    public $Son;

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

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage(String $Image)
    {
        $this->Image = $Image;
    }

    public function getSon()
    {
        return $this->Son;
    }

    public function setSon(String $Son)
    {
        $this->Son = $Son;
    }

    public function __construct(int $id, String $nom, String $Image ,String $Son)
    {
        $this->id = $id;
        $this->Nom = $nom;
        $this->Image = $Image;
        $this->Son = $Son;
    }
}
?>