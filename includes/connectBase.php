<?php
    $servername = 'localhost'; //nom du serveur
    $username = 'root'; //nom de l'utilisateur
    $password = ''; //mot de passe
    $dbname = 'citrouille'; //nom de la base de données
            
    try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //se connecte à la BDD
        } catch (Exception $e) {
            die('Erreur : connexion à la base de données impossible !' . $e->getMessage()); //erreur si il n'y a pas de connexion
        }
?>