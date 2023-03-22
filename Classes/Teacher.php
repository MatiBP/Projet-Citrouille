<?php
//include 'Liste.php';
include 'DaoTeacher.php';
class Teacher
{

    public $id;
    public $mail;
    public $login;
    public $mdp;


    public function getMail()
    {
        return $this->mail;
    }

    public function setMail(String $mail)
    {
        $this->mail = $mail;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(String $id)
    {
        $this->id = $id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin(String $login)
    {
        $this->login = $login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function setMdp(String $mdp)
    {
        $this->mdp = $mdp;
    }

    public function __construct(Int $id, String $login, String $mdp, String $mail)
    {
        $this->id = $id;
        $this->login = $login;
        $this->mdp = $mdp;
        $this->mail = $mail;
    }

    /**
     * Connecte le Teacher et le fait accéder a la page de menu
     */
    public function SeConnecter()
    {
        $TeacherDb = new DaoTeacher;

        if ($TeacherDb->Valider($this->getLogin(), $this->getMdp())) {
            echo '';
        } else {
            echo '';
        }
    }

    /**
     * ajoute un compte a la BDD
     */
    public function CreerCompte(String $login, String $mdp, $mdp2, String $mail)
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->CreerCompte($login, $mdp, $mdp2, $mail);
    }

    /**
     * rend un objet liste correspondant au numero entrer en parametre
     */
    public function rechercherListeNumero(int $numero)
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListeNumero($numero);
    }

    /**
     * rend un array d'objet liste correspondant au nom entre en parametre sinon ne renvoi rien
     */
    public function rechercherListe(String $list)
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListe($list);
    }

    /**
     * rend un array d'objet liste correspondant au liste contenant le mot entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeMot(String $mot)
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListeMot($mot);
    }

    /**
     * rend un array d'objet liste correspondant au niveau entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeNiveau(String $niveau)
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListeNiveau($niveau);
    }

    /**
     * rend un array d'objet liste correspondant au niveau entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeToutes()
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListeToutes();
    }

    /**
     * rend un array d'objet liste correspondant a l'ID du teacher sinon ne renvoi rien
     */
    public function rechercherListeUtilisateur()
    {
        $TeacherDb = new DaoTeacher;
        return $TeacherDb->rechercherListeUtilisateur($this->getId());
    }

    /**
     * Supprime la liste avec le nom correspondant
     */
    public function SupprimerListe(int $id)
    {
        $TeacherDb = new DaoTeacher;
        $TeacherDb->SupprimerListe($id);

        $Dest = "../listes/" . $id;
        rmdir($Dest);
    }

    /**
     * ajoute la liste en paramètre a la BDD
     */
    public function CreerListe(Liste $liste)
    {
        $TeacherDb = new DaoTeacher;
        $TeacherDb->CreerListe($liste, $this->getId());
    }

    /**
     * rend le lien vers la dictée de la liste passer en paramètre
     */
    public function CopierLienListe(Liste $liste)
    {
        $res = "http://localhost/GIT/projet-citrouille/afficherStudent.php?liste=" . $liste->id; //faut changer ca aussi
        return $res;
    }

    public function Valider(String $id, String $mdp)
    {

        $TeacherDb = new DaoTeacher;
        return $TeacherDb->Valider($id, $mdp);
    }


    /**
     * donne l'id de la dernière liste
     */
    public function LastId()
    {
        $Daoteacher = new DaoTeacher;
        return $Daoteacher->LastId();
    }
    public function changermdp($old, $new, $new2)
    {
        $Daoteacher = new DaoTeacher;
        $Daoteacher->changermdp($old, $new, $new2, $this->getId());
    }


    /**
     *Récupère numéro du teacher et compare à la liste si il est le créateur
     */
    public function CréateurListe(String $id)
    {
        $Daoteacher = new DaoTeacher;
        return $Daoteacher->CréateurListe($id);
    }
    public function CompteLibre($mail, $usernam)
    {
        $Daoteacher = new DaoTeacher;
        return $Daoteacher->CompteLibre($mail, $usernam, $this->getId());
    }
}

/*
$Test = new Liste("98", "animdddaux", "ce3");

$teacher = new Teacher("rumen", "1");
// $teacher->CreerListe($Test);



//n
//test rechercherListe
/* $teacher->rechercherListe("1");
    $zqgg=$teacher->rechercherListe("1");
    echo "DaoTeacher".$zqgg;
*/


//v
//test Valider
/*
$a = $teacher->rechercherListe("Animau");
echo "<br><br><br>Teacher renvoi :" . $a->getNom();
*/
    
    //V
    //test Creer Compte
    //$teacher->CreerCompte("admin","admin","admin@mail");
    
    //v
    //test SupprimerListe
    //$teacher->SupprimerListe("1");
    
    
    
    /*
    $Test = new Liste(1, "animaux");
    $Loutre = new Mot(9, "Loutre", "listes/1/4.jpg", "");
    
    $res = $Test->ChercherMot("chien");
    echo $res->Image;
    */
