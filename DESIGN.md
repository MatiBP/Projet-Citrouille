# Architecture

## Organisation des packages

### Classes

- connectBase.php : 
Elle permet de connecter la page à la BDD et doit donc être importer pour chaque interraction avec la BDD.

- includeClass.php : 
Elle facilite l'include des classes sur chaque page (Peut être remplacer par un include_once..)

- Admin.php : 
Elle contient les methodes spécifiques à un administrateur, comme changer un mdp ou un loging d'un utilisateur.

- DaoAdmin.php : 
Classe Dao de Admin qui interagit avec la BDD

- Teacher.php :
La classe Teacher possede la plupart des methodes, elle peut creer un compte, creer une liste, rechercher une liste, supprimer une liste..etc

- DaoTeacher.php : 
Classe Dao de Teacher qui interagit avec la BDD

- Liste.php : 
La classe permet d'interragire avec une liste, pour supprimer/ajouter/rechercher mot..etc 

- ListeDB.php : 
Classe Dao de Liste qui interagit avec la BDD

- Mot.php :
Elle permet la creation d'un mot avec une id,un nom, image et son.


### vue-contrôleur

- Admin :
Controller et vue. contient les vues des admins.

- AfficherTeacherStudent :
Controller et vue. Permet l'affichage de la dictée choisis par le professeur, et permet de l'apprendre avant de commencer la dictée (possibilité d'être redirigé pour modifier la liste).

- compte :
Controller et vue. Affiche le menu de connexion de creation de compte..etc.

- creeListe :
Controller et vue. Gère la création d'une liste avec l'importation d'un .zip.

- dictee :
Controller et vue. Gère le deroulement de la dictée, avec chaque nom des mots de la liste à rentrer selon l'image et le son disponible.

- menu :
Controller et vue. Affiche le menu du site, avec une barre de navigation (include) pour acceder aux differentes pages.

- Modifier :
Controller et vue. Gère la modification d'une liste.

- Rechercher :
Controller et vue. Permet de rechercher une liste grace à son nom, un mot present dans la liste et son niveau.

- sendmail :
Controller et vue. Gère la recuperation d'un compte avec quand l'utilisateur oublie sont mdp.

#### includes

Le package includes permet de stocker pour importer un script js ou une barre de navigation sur les differentes pages du site.

#### css

Les css des pages (avec l'utilisation de la css du site https://getbootstrap.com/)


# Architecture de l'application 

## Diagramme de cas dutilisation

<img src="../DiagrammeArchitecture/Diagramme_de_cas_dutilisation.png">

## Diagramme de classe

<img src="../DiagrammeArchitecture/Diagramme_de_classe.jpg">

## Diagramme MVC

<img src="../DiagrammeArchitecture/Diagramme_MVC_projet_CITROUILLE.png">