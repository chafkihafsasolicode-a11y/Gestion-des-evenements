<?php
require 'configue.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_ad.css">
</head>
<body>
    <form method="POST">
        <input type="text"name=recherche placeholder="rechercher">
        <button type="submit" name="ok">rechercher</button>

    </form>
    <a href="ajouter.php">Ajouter un évènement</a>
</body>
</html>

<?php
$sql="SELECT * FROM events ";
$stmt=$pdo->query($sql);
$events=$stmt->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['ok']) && !empty($_POST['recherche'])){
    $mot=$_POST['recherche'];
    $stmt=$pdo->prepare("SELECT * FROM events WHERE title LIKE :mot");
    $stmt->execute([
        'mot'=>"%$mot%"
    ]);

    $events=$stmt->fetchAll(PDO::FETCH_ASSOC);

}
echo "<table border='1'>
<tr><th>Title</th>
    <th>Date_event</th>
    <th>NbPlaces</th>
    <th>Price</th>
    <th>Location</th>
    <th>Nb_reservations</th>

</tr>";


foreach($events as $event){
    $sql="SELECT COUNT(*) as Nbreservation FROM reservations WHERE event_id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'id'=>$event['id']
    ]); 
    $Nbreservation=$stmt->fetch(PDO::FETCH_ASSOC);
    echo "<tr><td>{$event['title']}</td>
              <td>{$event['date_event']}</td>
              <td>{$event['nbPlaces']}</td>
              <td>{$event['price']}</td>
              <td>{$event['location']}</td>
              <td>{$Nbreservation['Nbreservation']}</td>

    </tr>";  
  }
    echo "</table>";



?>

