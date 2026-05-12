<?php
session_start();
require 'configue.php';

$user=$_SESSION['nom'];
$email=$_SESSION['email'];
$userid=$_SESSION['id'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_pro.css">
</head>
<body>
    <a href="index.php">Retour</a>
    <form method="POST">
    <button type="submit" name="ok">Déconnexion</button>
    </form>

    <?php
if(isset($_POST['ok'])){
    header('Location:logout.php');
    exit;
} echo "<div>";
    echo "<h2>Informations personnel</h2>";
    echo "<p> Nom: $user</p>";
    echo "<p> Email: $email</p>";
    echo "</div>";
?>
</body>
</html>

<?php
$sql="SELECT events.title,events.date_event FROM reservations
INNER JOIN events ON reservations.event_id = events.id
WHERE reservations.user_id = :u_id";
$stmt=$pdo->prepare($sql);
$stmt->execute(["u_id"=>$userid]);
$events=$stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($events as $event) {
    echo "<div>";
    echo "<p>{$event['title']}</p>";
    echo "<p>{$event['date_event']}</p>";
    echo "</div>";
}


?>