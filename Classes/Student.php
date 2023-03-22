<?php
//include 'mot.php';
//include 'liste.php';
include 'DaoStudent.php';
class Student
{

    public $liste;
    public $id;

    public function getListe()
    {
        return $this->liste;
    }

    public function setListe(Liste $liste)
    {
        $this->liste = $liste;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function __construct(Liste $liste, int $id)
    {
        $this->liste = $liste;
        $this->id = $id;
    }

    public function commencerUneDictee()
    {
        //????
    }

    public function rentrerUnMot(Mot $mot)
    {
        $DaoStudent = new DaoStudent;
        $DaoStudent->rentrerUnMot($mot, $this->getListe(), $this->getId());
    }
}
