<?php
session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}
//Get form data
if(isset($_POST['type'])){
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
if(isset($_POST['itemID'])){
  $itemID = $_POST['itemID'];
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
  $insert=$db->prepare("UPDATE item SET `Type`=?, `FoundDate`=?, `FoundAddLine1`=?, `FoundAddLine2`=?, `FoundPostCode`=?, `Colour`=?, `Photo`=?, `Description`=?
    WHERE `ItemID`=?
  " );
  $insert->execute(array($type, $date, $addline1, $addline2, $postcode, $colour, $file, $description, $itemID));

  //Insert into jewellery table
  if($type == "Jewellery"){
    $insert=$db->prepare("UPDATE jewellery SET `type`=? `materialType`=? WHERE `itemID`=?" );
    $insert->execute(array($jewelleryType, $materialType, $itemID));
  }

  //Insert into electronics table
  if($type == "Electronics"){
    $insert=$db->prepare("UPDATE electronics SET `type`=?, `make`=? WHERE `itemID`=?" );
    $insert->execute(array($elecType, $elecMake, $itemID));
  }

  //Insert into pet table
  if($type == "Pet"){
    $insert=$db->prepare("UPDATE pet SET `Name`=?, `type`=?, `breed`=? WHERE `itemID`=?" );
    $insert->execute(array($name, $petType, $breed,$itemID));
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
