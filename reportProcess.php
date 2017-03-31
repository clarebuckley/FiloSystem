<?php
session_start();
//Get form data, all are required in report.php
if(strcmp($_POST['type'],"Please select...") != 0){
  $type = $_POST['type'];
}
if(isset($_POST['date'])){
  $date = $_POST['date'];
}
if(isset($_POST['addline1'])){
  $addline1 = $_POST['addline1'];
}
if(isset($_POST['addline2'])){
  $addline2 = $_POST['addline2'];
}
if(isset($_POST['postcode'])){
  $postcode = $_POST['postcode'];
}
if(isset($_POST['colour'])){
  $colour = $_POST['colour'];
}
if(($_FILES['photo']['size'] > 0) && ($_FILES['photo']['error'] == 0)) {
  $photo = explode('.', $_FILES['photo']['name']);
  $extension = strtolower(end($photo));
  if(($extension == "jpg") || ($extn == "jpeg") || ($extn == "gif")) {
    $file = fopen($_FILES['photo']['tmp_name'], "rb");
  }
}
if(isset($_POST['description'])){
  $description = $_POST['description'];
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data     #*******CHANGE USER
  $insert=$db->prepare("INSERT INTO item (`FoundUser`, `Type`, `FoundDate`, `FoundAddLine1`, `FoundAddLine2`, `FoundPostCode`, `Colour`, `Photo`, `Description`)
  VALUES(?,?,?,?,?,?,?,?,?)" );
  $insert->execute(array('1', $type, $date, $addline1, $addline2, $postcode, $colour, $file, $description));
  echo "Added item successfully!";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
