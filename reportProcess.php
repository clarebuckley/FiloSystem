<?php
session_start();
if (! isset($_SESSION['name'])){
  header("Location: index.php");
}
//Get form data, all are required in report.php
$userID = $_SESSION['userID'];
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
//Jewellery-specific fields
if(isset($_POST['jewelleryType'])){
  $jewelleryType = $_POST['jewelleryType'];
}
if(isset($_POST['materialType'])){
  $materialType = $_POST['materialType'];
}
//Electronics-specific fields
if(isset($_POST['elecType'])){
  $elecType = $_POST['elecType'];
}
if(isset($_POST['elecMake'])){
  $elecMake = $_POST['elecMake'];
}
//Pet-specific fields
if(isset($_POST['petType'])){
  $petType = $_POST['petType'];
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
  $insert=$db->prepare("INSERT INTO item (`FoundUser`, `Type`, `FoundDate`, `FoundAddLine1`, `FoundAddLine2`, `FoundPostCode`, `Colour`, `Photo`, `Description`)
  VALUES(?,?,?,?,?,?,?,?,?)" );
  $insert->execute(array($userID, $type, $date, $addline1, $addline2, $postcode, $colour, $file, $description));

  //Insert into jewellery table
  if($type == "Jewellery"){
    $itemID = $db->query("SELECT MAX(ItemID FROM item");
    $insert=$db->prepare("INSERT INTO jewellery (`itemID`, `type`, `materialType`)
    VALUES(?,?,?)" );
    $insert->execute(array($itemID, $jewelleryType, $materialType));
  }

  //Insert into electronics table
  if($type == "Electronics"){

  }

  //Insert into pet table
  if($type == "Pet"){

  }


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
