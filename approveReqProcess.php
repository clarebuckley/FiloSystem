<?php
session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
  $update=$db->prepare("UPDATE request SET`isApproved`=1 WHERE requestedItem=?" );
  $update->execute(array($_GET['id']));
  echo "Approved item! <p><a href='home.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
