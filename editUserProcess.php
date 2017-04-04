<?php
session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}

$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userID = $_POST['userID'];
$query=$db->query("SELECT * FROM user WHERE UserID ='$userID'");
$item=$query->fetch();


//Get form data
if(isset($_POST['title'])){
  $title = $_POST['title'];
} else{
  $title = $user['Title'];
}
if(isset($_POST['forename'])){
  $forename = $_POST['forename'];
} else {
  $forename = $item['Forename'];
}
if(isset($_POST['surname'])){
  $surname = $_POST['surname'];
}else {
  $surname = $user['Surname'];
}
if(isset($_POST['username'])){
  $username = $_POST['username'];
}else {
  $username = $user['Username'];
}
if(isset($_POST['password'])){
  $password = md5($_POST['password']);
}else {
  $password = $user['Password'];
}
if(isset($_POST['email'])){
  $email = $_POST['email'];
}else {
  $email = $user['Email'];
}
if(isset($_POST['userType'])){
  $userType = $_POST['userType'];
}else {
  $userType = $user['UserType'];
}

try{
  //Insert record using form data
  $insert=$db->prepare("UPDATE user SET `Username`=?, `Password`=?, `Title`=?, `Forename`=?, `Surname`=?, `Email`=?, `UserType`=?
    WHERE `UserID`=?
  " );
  $insert->execute(array($username, $password, $title, $forename, $surname, $email, $userType, $userID));

  echo "Updated user information successfully! <p><a href='userOptions.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
