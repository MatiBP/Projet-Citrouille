<!DOCTYPE html>
<html>

<head>
    <title>Mot de passe oublié</title>
    <meta charset="utf-8">
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../css/mdpoublie.css" rel="stylesheet" type="text/css">
    <?php
    if (!empty($_SESSION['teacher']))
        header('Location: ../menu/menu.php');
    include('../includes/connectBase.php');
    include('../includes/barreInvite.php');
    ?>
</head>

<body>
<div id="container2">
    
    <form method="post">
        <h1> Mot de passe oublié</h1>
        
        <p> Mail: </p>
        <input type="email" placeholder="Entrer email" name="email" required>
        <input type="submit" value="Envoyer un email">
    </form>
<div>

</body>

</html>

<?php
//envoie un mail
if (isset($_POST['email'])) {
    //fonction pour choisir un mdp et le hash
    $password = uniqid();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $message = "Bonjour, voici votre nouveau mot de passe : $password";
    $header = "MIME-Version: 1.0\r\n";
    $headers = "From: citrouilleprojet@outlook.com";
    $header .= 'Content-Type:text/html; charset="uft-8"' . "\n";
    $header .= 'Content-Transfer-Encoding: 8bit';

    if (mail($_POST['email'], 'Mot de passe oublié', $message, $header)) {
        $sql = "UPDATE user SET password = ? WHERE mail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$hashedPassword, $_POST['email']]);
        echo "Mail envoyé";
        header('Location: connexion.php');
    } else {
        echo " Une erreur est survenu.";
    }
    
}
?>