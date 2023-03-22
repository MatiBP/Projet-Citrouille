<?php

use LDAP\Result;

class DaoTeacher
{


    /*

    /**
     * rend un array d'objet liste correspondant au nom entrer en parametre sinon ne renvoi rien
     */
    public function rechercherListe(String $list)
    {
        //Mettre valeur de bdd dans valeur

        include 'connectBase.php';

        $res = array();
        $sql =  'SELECT * FROM `liste` WHERE nom = "' . $list . '"';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error Chercher Liste";
            exit;
        } else {

            if ($result->rowCount() == 0) {
                // il n'y a pas de liste de ce nom
            } else {
                foreach ($result as $result) {
                    array_push($res, new Liste($result['numero'], $result['nom'], $result['niveau']));
                }
            }
        }
        return $res;
    }

    /**
     * rend un array d'objet liste correspondant au liste contenant le mot entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeMot(String $mot)
    {
        include '../Classes/connectBase.php';
        $res = array();
        $sql = "SELECT * FROM liste";
        $result = $conn->query($sql);
        if (!$result) {
            echo "erreur";
            exit;
        } else {
            foreach ($result as $row) {
                $nb = $row['numero'];
                $sql = "SELECT * FROM `$nb` WHERE mot = '$mot'";
                $result2 = $conn->query($sql);
                if (!$result2) {
                    echo "erreur";
                    exit;
                } else {
                    foreach ($result2 as $row2) {
                        array_push($res, new Liste($row['numero'], $row['nom'], $row['niveau']));
                    }
                }
            }
        }
        return $res;
    }


    /**
     * rend un objet liste correspondant au numero entrer en parametre sinon ne renvoi rien
     */
    public function rechercherListeNumero(int $numero)
    {
        //Mettre valeur de bdd dans valeur

        include 'connectBase.php';

        $sql =  'SELECT * FROM `' . $numero . '`';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error Chercher Liste";
            exit;
        } else {
            $liste = array();
            $cpt = 0;
            foreach ($result as $result) {
                $cpt++;
                $liste[$cpt] = new Mot($result['numero'], $result['mot'], $result['image'], $result['son']);
            }
        }


        return $liste;
    }

    /**
     * rend un array d'objet liste correspondant au niveau entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeNiveau(String $list)
    {
        //Mettre valeur de bdd dans valeur

        include 'connectBase.php';

        $res = array();
        $sql =  'SELECT * FROM `liste` WHERE niveau = "' . $list . '"';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error Chercher Liste";
            exit;
        } else {

            if ($result->rowCount() == 0) {
                // il n'y a pas de liste de ce niveau
            } else {
                foreach ($result as $result) {
                    array_push($res, new Liste($result['numero'], $result['nom'], $result['niveau']));
                }
            }
        }
        return $res;
    }

    /**
     * rend un array d'objet liste correspondant au niveau entre en parametre sinon ne renvoi rien
     */
    public function rechercherListeToutes()
    {
        //Mettre valeur de bdd dans valeur

        include 'connectBase.php';

        $res = array();
        $sql =  'SELECT * FROM `liste`';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error Chercher Liste";
            exit;
        } else {

            if ($result->rowCount() == 0) {
                //aucune liste dans la BDD
            } else {
                foreach ($result as $result) {
                    array_push($res, new Liste($result['numero'], $result['nom'], $result['niveau']));
                }
            }
        }
        return $res;
    }

    /**
     * rend un array d'objet liste correspondant a l'ID du teacher sinon ne renvoi rien
     */
    public function rechercherListeUtilisateur($id)
    {
        //Mettre valeur de bdd dans valeur

        include 'connectBase.php';

        $res = array();
        $sql =  'SELECT * FROM `liste` WHERE user = "' . $id . '"';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error Chercher Liste";
            exit;
        } else {

            if ($result->rowCount() == 0) {
                //Cet utilisateur n'a pas fait de liste
            } else {
                foreach ($result as $result) {
                    array_push($res, new Liste($result['numero'], $result['nom'], $result['niveau']));
                }
            }
        }
        return $res;
    }

    /** Fonctionnel
     * Supprime la liste avec le nom correspondant
     */
    public function SupprimerListe(String $id)
    {
        include 'connectBase.php';
        $sql = "DROP TABLE `$id`;  DELETE FROM `liste` WHERE numero =  $id;";
        $result = $conn->query($sql);
        if (!$result) {
            echo 'erreur';
            exit;
        }
        $sql = 'UPDATE `liste` SET numero = (numero-1) WHERE numero > ' . $id;
        $result = $conn->query($sql);
    }



    /**
     * ajoute la liste en paramètre a la BDD
     */
    public function CreerListe(Liste $liste, $idUser)
    {


        include 'connectBase.php';
        $id = $liste->id;
        $nom = $liste->Nom;
        $niveau = $liste->niveau;

        $req = $conn->prepare("INSERT INTO `liste` (numero, nom, niveau,user,shareWeb)VALUES('$id','$nom', '$niveau', '" . $idUser . "','0');
             CREATE TABLE `$id` (
              `numero` int(250) NOT NULL,
              `numeroListe` int(250) NOT NULL,
              `mot` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
              `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
              `son` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
              PRIMARY KEY (`numero`),
            KEY `FK_." . $id . "` (`numeroListe`)
)
 ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 ALTER TABLE `$id` ENGINE=InnoDB;

 ALTER TABLE `$id` ADD CONSTRAINT `FK_." . $id . "` FOREIGN KEY (`numeroListe`) REFERENCES `liste`(`numero`) ON DELETE RESTRICT ON UPDATE RESTRICT;");
        $result = $req->execute();
        if (!$result) {
            echo "erreur";
        }
    }



    public function Valider($usernam, $motDePasse)
    {
        include 'connectBase.php';
        $sql =  "SELECT * FROM `user` WHERE username = '$usernam'";
        $result = $conn->query($sql);
        if (!$result) {
            return 1;
        } else {
            if ($result->rowCount() == 0) {
                return 2;
            }
            //verifier les requetes pour securiser la BDD
            foreach ($result as $row) {
                //vérification des mots de passe hashés
                $identique = password_verify($motDePasse, $row['password']);
                if ($identique) {
                    if ($row['admin'] == 1) {
                        $admin = new Admin($row['IDUser'], $usernam, $row['mail'], "");
                        $teacher = new Teacher($row['IDUser'], $usernam, "", $row['mail']);
                        $res = array(1 => $admin, 2 => $teacher);
                        return $res;
                    } else {
                        $teacher = new Teacher($row['IDUser'], $usernam, "", $row['mail']);
                        return $teacher;
                    }
                } else {
                    return 2;
                }
            }
            return 3;
        }
    }

    public function LastId()
    {
        include 'connectBase.php';

        $sql =  'SELECT * FROM liste';
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error LastId()";
            exit;
        } else {
            return $result->rowCount();
        }
    }

    /**
     * ajoute un compte a la BDD
     */
    public function CreerCompte(String $usernam, String $motDePasse, $motDePasse2, $mail)
    {
        include 'connectBase.php';
        if ($motDePasse != $motDePasse2) {
            //comparaison des mots de passe, erreur 1 si faux
            return 1;
        } else {
            $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT); //hasher le mot de passe
        }
        //verification que le nom de l utilisateur est deja pris, erreur 2 si oui
        //Erreur 3 si la connexion au serveur n'a pas marche
        $requete = "SELECT username FROM user WHERE username = '$usernam'";
        $resultat = $conn->query($requete);
        if (!$resultat) {
            return 3;
        } else {
            while ($donnees = $resultat->fetch()) //Si le nom est deja pris
            {
                return 2;
            }
        }

        //verification que le mail de l utilisateur est deja pris, erreur 4 si oui
        $requete = "SELECT mail FROM user WHERE mail = '$mail'";
        $resultat = $conn->query($requete);

        if (!$resultat) {
            return 3;
            exit;
        } else {
            while ($donnees = $resultat->fetch()) {
                return 4;
                exit;
            }
        }

        //envoie la requete si tout est bon
        $req = $conn->prepare('INSERT INTO user(username, mail, password, admin) 
        VALUES(:username, :mail, :motDePasse, 0)');
        $req->execute(array('username' => $usernam, 'mail' => $mail, 'motDePasse' => $motDePasseHash));

        $sujet = "Creation du compte";
        $corp = "Bonjour $usernam, et bienvenue sur le site projet citrouille. Votre compte à bien été créé ! Amusez vous avec vos dictées de la part de l'équipe";
        $headers = "From: citrouilleprojet@outlook.com";
        if (!mail($mail, $sujet, $corp, $headers)) {
            return 5;
        }
    }

    public function changermdp($old, $new, $new2, $id)
    {
        include 'connectBase.php';

        $sql =  "SELECT * FROM `user` WHERE IDUser = '$id'";
        $result = $conn->query($sql);
        if (!$result) {
            //erreur de la BDD (erreur 1)
            return 1;
        } else {
            foreach ($result as $row) {
                //vérification que l'ancien mot de passe est bon
                $identique = password_verify($old, $row['password']);
                if (!$identique) {
                    //erreur dans l ancien mdp, pas le meme (erreur 2)
                    return 2;
                }
            }
        }
        if ($new != $new2) {
            //erreur les nouveaux mdp sont pas les memes (erreur 3)
            return 3;
        }
        $motDePasseHash = password_hash($new, PASSWORD_DEFAULT); //hasher le mot de passe
        $sql = "UPDATE user SET password = ? WHERE `IDUser` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$motDePasseHash, $id]);
    }


    /**
          *Récupère numéro du teacher et compare à la liste si il est le créateur
          */
    public function CréateurListe(String $id)
    {
        include 'connectBase.php';
        $sql = "SELECT user FROM liste WHERE numero = $id ";
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Erreur 1';
            exit;
        }
        foreach ($result as $result) {
            $a = $result['user'];
        }


        $sql = "SELECT username FROM user where IDUser = $a"; //tout mettre dans tableau
        $result = $conn->query($sql);
        if (!$result) {
            echo 'Erreur 2';
            exit;
        }
        foreach ($result as $result) {
            $a = $result['username'];
        }

        return $a;
    }

    public function CompteLibre($mail, $usernam, $id)
    {

        include 'connectBase.php';

        $requete = "SELECT username FROM user WHERE username = '$usernam'";
        $resultat = $conn->query($requete);

        if (!$resultat) {
            return 3;
            exit;
        } else {
            while ($donnees = $resultat->fetch()) //Si le nom est deja pris
            {
                return 2;
                exit;
            }
        }

        $requete = "SELECT mail FROM user WHERE mail = '$mail'";
        $resultat = $conn->query($requete);

        if (!$resultat) {
            return 3;
            exit;
        } else {
            while ($donnees = $resultat->fetch()) {
                return 4;
                exit;
            }
        }

        $sql = "UPDATE user SET password = ? WHERE mail = ?";
        $sql = "UPDATE `user` SET `username` = ?, `mail` = ? WHERE `user`.`IDUser` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usernam, $mail, $id]);
    }
}
