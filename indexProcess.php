<?php
session_start();

$username;
$password;

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

//Sanitise inputs
$safe_username = $db->quote($username);
//Get user data
$rows=$db->query("SELECT * FROM user");


//Check if this username/password combination is in user table
foreach($rows as $row){
  echo("Password: " .$password . "   DB:" . $row["Password"]);
  if (($row["Password"] == $password) && (strcmp($row["Username"],$safe_username) == 0)){
    header( 'Location: index.html' );
  }
  else {
    echo("rejected");
  }
}
 ?>
