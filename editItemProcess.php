<?php
session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}
//Get form data
if(isset($_POST['type']){
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
if(isset($_POST['name'])){
  $name = $_POST['name'];
}
if(isset($_POST['breed'])){
  $breed = $_POST['breed'];
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
  $insert=$db->prepare("UPDATE item (`Type`, `FoundDate`, `FoundAddLine1`, `FoundAddLine2`, `FoundPostCode`, `Colour`, `Photo`, `Description`)
  VALUES(?,?,?,?,?,?,?,?)" );
  $insert->execute(array($type, $date, $addline1, $addline2, $postcode, $colour, $file, $description));

  //Insert into jewellery table
  if($type == "Jewellery"){
    $insert=$db->prepare("INSERT INTO jewellery (`type`, `materialType`)
    VALUES(?,?)" );
    $insert->execute(array($jewelleryType, $materialType));
  }

  //Insert into electronics table
  if($type == "Electronics"){
    $insert=$db->prepare("INSERT INTO electronics (`type`, `make`)
    VALUES(?,?)" );
    $insert->execute(array($elecType, $elecMake));
  }

  //Insert into pet table
  if($type == "Pet"){
    $insert=$db->prepare("INSERT INTO pet (`Name`, `type`, `breed`)
    VALUES(?,?,?)" );
    $insert->execute(array($name, $petType, $breed));
  }


  echo "Updated item successfully! <p><a href='home.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
