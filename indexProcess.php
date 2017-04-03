<?php
session_start();

//Get username and password from the form
if(isset($_POST['username'])){
  $username = $_POST['username'];
}
if(isset($_POST['password'])){
  $password = md5($_POST['password']);
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Sanitise username
$safe_username = $db->quote($username);
//Get user data
$rows=$db->query("SELECT * FROM user");


//Check if this username/password combination is in user table
foreach($rows as $row){
  echo("Password: " .$password . "   DB:" . $row["Password"]);
  if (($row["Password"] == $password) && (strcmp($db->quote($row["Username"]),$safe_username) == 0)){
    $_SESSION['name']=$safe_username;
    $_SESSION['userType']=$row["UserType"];
    $_SESSION['userID']=$row["UserID"];
    header( 'Location: home.php' );
  }
  else {
    echo("Username or password incorrect");
  }
}
 ?>
