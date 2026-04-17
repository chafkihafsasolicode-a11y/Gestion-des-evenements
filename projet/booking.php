<?php
session_start();
require 'configue.php';

if(!isset($_SESSION['nom'])){
    header('Location:login.php');
    exit;
}

if(isset($_GET['id'])){
    $userid=$_SESSION['id']  ;
    $id=$_GET['id'];

    $stmt=$pdo->prepare("SELECT * FROM events WHERE id=:id");
    $stmt->execute([
        'id'=>$id
    ]);
    $event=$stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['confirme'])){
       
            if($event && $event['nbPlaces'] > 0){
            $stmt=$pdo->prepare("INSERT INTO reservations(user_id, event_id) VALUES(:user_id, :event_id)");
            $stmt->execute([
                'user_id'=>$userid,
                'event_id'=>$id
            ]);
            $stmt=$pdo->prepare("UPDATE events SET nbPlaces = nbPlaces - 1 WHERE id=:id");
            $stmt->execute([
                'id'=>$id
            ]);
            echo "Réservation réussie !";
        }
       
    }
}
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style_booking.css">
    </head>

    <body>
    <?php
    if($event){
        echo "<a href='index.php'>retour</a>";
    echo "<div>
        <h3>{$event['title']}</h3>
        <p>Date: {$event['date_event']}</p>
        <p>Places restantes: {$event['nbPlaces']}</p>
        <p>Prix: {$event['price']}</p>
        <p>Lieu:{$event['location']}</p>";
        if($event['nbPlaces'] > 0){echo "
        <form method='POST'>
        <button type='submit' name='confirme'>Confirmer la réservation</button>
        </form>";}
        else {
           echo "<button>Sold out</button>";
        }
     echo "</div>";
    }
 ?>
        
    </body>
    </html>
