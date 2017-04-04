<?php
session_start();
//Get form data, all are required in register.php
$title = $_POST['title'];
if(isset($_POST['forename'])){
  $forename = $_POST['forename'];
}
if(isset($_POST['surname'])){
  $surname = $_POST['surname'];
}
if(isset($_POST['username'])){
  $username = $_POST['username'];
}
if(!empty(trim($_POST['password']))){
  if($_POST['password'] == $_POST['passwordCheck']){
    $password = md5($_POST['password']);
  }else{
    echo("Error: passwords didn't match. Please return and re-enter your password.</br><p><a href='register.php'>Back</a></p>");
    die();
  }

}
if(isset($_POST['email'])){
  $email = $_POST['email'];
}
//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try{
  //Insert record using form data
  $insert=$db->prepare("INSERT INTO user (`Username`, `Password`, `Title`, `Forename`, `Surname`, `Email`, `UserType`) VALUES(?,
  ?,?,?,?,?,?)" );
  $insert->execute(array($username, $password, $title, $forename, $surname, $email, 'Registered'));
  echo "Added " . $title . " " . $forename . " " . $surname . " successfully! <p><a href='home.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
