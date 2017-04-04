<?php
session_start();
if (! isset($_SESSION['name'])){
  header("Location: index.php");
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['id'])){
  $id = $_POST['id'];
}
//Get data to send to the database
$user = $_SESSION['userID'];
if(isset($_POST['reason'])){
  $reason = $_POST['reason'];
}
$date = date("Y/m/d");

try{
  //Insert record using form data
  $insert=$db->prepare("INSERT INTO request (`requestedUser`, `requestedItem`, `dateRequested`, `reason`, `isApproved`)
  VALUES(?,?,?,?,?)" );
  $insert->execute(array($user, $id, $date, $reason, "Pending"));
  echo "Request sent successfully! <a href='home.php'>Home</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}

 ?>
