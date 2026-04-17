<?php
session_start();
require 'configue.php';
if(isset($_POST['ok'])){
    if(isset($_SESSION['nom'])){
      $event_id = $_POST['id'];
      
    header('Location:booking.php?id='.$event_id.'');
    exit;}
    else {
      header('Location:login.php');
      exit;
    }
}

$sql="SELECT * FROM events";
$stmt=$pdo->query($sql);
$events=$stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php 
  if(isset($_SESSION['nom'])){
    echo "<form method='POST'><button name='profil'>{$_SESSION['nom']}</button></form>";
    
  }else{
  
     echo "<a href='login.php'>Login</a>";
    }?>
     <h1>Les évènements</h1>

      <div class='carte'>
        <?php
      foreach($events as $event){
          echo "<div class='card'>
          <h3>{$event['title']}</h3>
          <p>{$event['date_event']}</p>
        <form method='POST'>
        <input type='hidden' name='id' value='{$event['id']}'>
        <button type='submit' name='ok'>Reserver</button>
        </form>
          </div>";
      }
  ?>
  </div>
</body>
</html>

<?php
if(isset($_POST['profil'])){
  header('Location:profil.php');
  exit;
}