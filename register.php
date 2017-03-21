<?php
//Get form data, all are required in register.html
$title = $_POST['title'];
if(isset($_POST['forename'])){
  $forename = $_POST['forename'];
}
if(isset($POST['surname'])){
  $surname = $_POST['surname'];
}
if(isset($_POST['username'])){
  $username = $_POST['username'];
}
if(!empty(trim($_POST['password']))){
  $password = $_POST['password']; #needs to be hashed
}
if(isset($_POST['email'])){
  $email = $_POST['email'];
}
//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
$insert=$db->prepare("INSERT INTO user (`Username`, `Password`, `Title`, `Forename`, `Surname`, `Email`, `UserType`) VALUES(:pusername,
  '".$password."','".$title."',:pforename,:pusername,:pemail,'Admin');" );
  $insert->bindParam(':pusername',$username, PDO::PARAM_STR, 10);
  $insert->bindParam(':pforename',$forename, PDO::PARAM_STR, 20);
  $insert->bindParam(':psurname',$surname, PDO::PARAM_STR, 20);
  $insert->bindParam(':pemail',$email, PDO::PARAM_STR, 30);
  $insert->execute();
  echo "Added record successfully";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
