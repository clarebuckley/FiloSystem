<?php
session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$status=$_GET["option"];
try{
  //Insert record using form data
  $update=$db->prepare("UPDATE request SET`isApproved`=? WHERE requestedItem=?" );
  $update->execute(array($status, $_GET['id']));
  echo "Approved status updated successfully! <p><a href='home.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
