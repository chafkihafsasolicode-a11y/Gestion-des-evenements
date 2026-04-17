<?php
session_start();
require 'configue.php';

if(isset($_POST['ok'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    if(empty($email) || empty($password)){
        echo "<p style='color:red;'>tous les champs obligatoires</p>";
    }
    else {

        $stmt=$pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute([
            'email'=>$email
        ]); 
        $user=$stmt->fetch(PDO::FETCH_ASSOC);

       
           if($user){

           if ($user['password'] !== $password) {
            echo "password incorrect!";  
        }
        else{

        $_SESSION['id']=$user['id'];
        $_SESSION['nom'] =$user['name'];
        $_SESSION['email'] =$user['email'];
        
        header('Location:index.php');
        exit;
    }
}else{
    echo "Email introuvable";
}
    }
}?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_lo.css">
</head>
<body>
    <form method="POST">
        <h1>Connexion</h1>
        <input type="email" name="email" placeholder="Entrer l'email">
        <input type="password" name="password" placeholder="mot de passe">
        <button type="submit" name="ok">Login</button>
        <a href='signup.php'>S'inscrire</a>
    </form>
    
</body>
</html>
