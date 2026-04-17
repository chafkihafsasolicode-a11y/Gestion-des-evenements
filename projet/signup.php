<?php
  session_start();
require 'configue.php';?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_sign.css">
 </head>
 <body>
    <form method="POST">
        <label>Nom</label>
        <input type="text" name="nom">
        <label>Email</label>
        <input type="email" name="email">
        <label>password</label>
        <input type="password" name="password">
        <label>confirmation</label>
        <input type="password" name="confirme">
        <button type="submit" name="ok">connexion</button>
    </form>
 </body>
 </html>

 <?php
 if(isset($_POST['ok'])){
    $nom=$_POST['nom'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirme=$_POST['confirme'];
    if(empty($nom) || empty($email) || empty($password) || empty($confirme) ){
        echo "tous les champs sont obligatoires";
    } else{
        if(strlen($password)<8){
            echo "Le mot de passe doit contenir au moins 8 caractères";
        }
        if(!preg_match("/[A-Z]/",$password)){
            echo"Le mot de passe doit contenir au moins une lettre majuscule";
        }
        if(!preg_match("/[0-9]/",$password)){
            echo "Le mot de passe doit contenir au moins un chiffre";
        }
        if($confirme !== $password){
            echo "Les mots de passe ne correspondent pas";
        }

         $stmt=$pdo->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :password)");
         $stmt->execute([
            'name'=>$nom,
            'email'=>$email,
            'password'=>$password
         ]);
         $user=$stmt->fetch(PDO::FETCH_ASSOC);

         $_SESSION['name']=$nom;
         $_SESSION['email']=$email;
         $_SESSION['password'];
       
        header('Location:index.php');
        exit;
    


 }

 }
?>













