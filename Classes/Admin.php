<?php
include 'DaoAdmin.php';
class Admin
{

    public $idUser;
    public $loging;
    public $mail;
    public $mdp;

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser(String $idUser)
    {
        $this->idUser = $idUser;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail(String $mail)
    {
        $this->mail = $mail;
    }

    public function getLoging()
    {
        return $this->loging;
    }

    public function setLoging(String $loging)
    {
        $this->loging = $loging;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp(String $mdp)
    {
        $this->mdp = $mdp;
    }

    public function __construct(int $idUser, String $loging, String $mail, String $mdp)
    {
        $this->idUser = $idUser;
        $this->loging = $loging;
        $this->mail = $mail;
        $this->mdp = $mdp;
    }

    public function modifierMdp(String $loging, String $NewMdp)
    {
        $DaoAdmin = new DaoAdmin;
        $DaoAdmin->modifierMdp($loging, $NewMdp);
    }

    public function modifierLoging(String $loging, String $NewLoging)
    {
        $DaoAdmin = new DaoAdmin;
        $DaoAdmin->modifierLoging($loging, $NewLoging);
    }

    public function modifierDroit(String $loging, int $droit)
    {
        $DaoAdmin = new DaoAdmin;
        $DaoAdmin->modifierDroit($loging, $droit);
    }

    public function RecuperProfils()
    {
        $DaoAdmin = new DaoAdmin;
        $Profils = $DaoAdmin->RecuperProfils();
        return $Profils;
    }
}

