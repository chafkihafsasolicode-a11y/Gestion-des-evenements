<?php
require 'configue.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_ajo.css">
</head>
<body>
      <a href="admin.php">Retour</a>
    <form method="POST">
        <label>Nom de l'évènement</label>
        <input type="text" name="nom">

        <label>Date de  l'évènement</label>
        <input type="date" name="date">

        <label>NbPlaces</label>
        <input type="number" name="nbplace">

        <label>Price</label>
        <input type="number" name="price">

        <label>Location</label>
        <input type="text" name="location">
        <button type="submit" name="ok">Ajouter</button>
    </form>
    
</body>
</html>

<?php
if(isset($_POST['ok'])){
    $nom=$_POST['nom'];
    $date=$_POST['date'];
    $nbplace=$_POST['nbplace'];
    $price=$_POST['price'];
    $location=$_POST['location'];
    if(empty($nom) || empty($date) || empty($nbplace) || empty($price) || empty($location)){
        echo "Tous les champs sont obligatoires";
    }else{
        $stmt=$pdo->prepare("INSERT INTO events(title, date_event, nbPlaces, price, location) VALUES(:title, :date_event, :nbPlaces, :price, :location)");
        $stmt->execute([
            'title'=>$nom,
            'date_event'=>$date,
            'nbPlaces'=>$nbplace,
            'price'=>$price,
            'location'=>$location
        ]);

        echo "ajouteé avec succès";
    }
}