<?php
//Get form data, all are required in report.html
$type = $_POST['type'];
if(isset($_POST['date'])){
  $date = $_POST['date'];
}
if(isset($POST['addline1'])){
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
  var_dump($_POST);
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
VALUES('1','".$type."',:pdate,:padd1,:padd2,:ppostcode,:pcolour,'".$photo."',:pdescription);" );
  $insert->bindParam(':pdate',$date, PDO::PARAM_STR, 10);
  $insert->bindParam(':padd1',$addline1, PDO::PARAM_STR, 20);
  $insert->bindParam(':padd2',$addline2, PDO::PARAM_STR, 20);
  $insert->bindParam(':ppostcode',$postcode, PDO::PARAM_STR, 20);
  $insert->bindParam(':pcolour',$colour, PDO::PARAM_STR, 10);
  $insert->bindParam(':pdescription',$description, PDO::PARAM_STR, 30);
  $insert->execute();
  echo "Added record successfully!";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
