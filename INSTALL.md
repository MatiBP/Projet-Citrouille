# INSTALL

## Wamp
Pour installer le projet :  
-Il faut commencer par installer [wamp64](https://www.wampserver.com/en/download-wampserver-64bits/) !  
-Glisser le fichier du projet décompressé dans le répertoire wamp sur votre ordinateur (dans wamp64/www). 
-Lancer wamp64 avec le compte "root" sans mot de passe.

Créer une nouvelle table nommée "citrouille" en utf8_unicode_ci. Importer le fichier citrouille.sql pour créer la table.

## Mail
[Tuto](https://waytolearnx.com/2020/01/comment-configurer-wampserver-pour-envoyer-un-mail-depuis-localhost-en-php.html) à suivre pour les mails.
 
Le smtp d'un serveur outlook est "smtp-mail.outlook.com".

Dans le fichier Classes\DAOTeacher.php: ligne 324 -> mail à changer par votre mail.

Dans le fichier compte\mdpoublie.php: ligne 42 -> mail à changer par votre mail.

## Pour tester
Un compte administrateur est déjà créé avec nom "admin" et mot de passe "admin".
Vous pouvez créer votre compte dans l'onglet inscription. 

Dans le fichier "AfficherTeacher" dans le repertoire "\AfficherTeacherStudent\" changer le lien à la ligne 120 en fonction de là où est enregistré le fichier.
A vous de jouer !
