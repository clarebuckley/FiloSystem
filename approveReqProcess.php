<?php
session_start();
//Only admins allowed access to this script
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}

//Connect to database through PDO
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Whether the request is being accepted or rejected
$status=$_GET["option"];

function sendEmail(){
  //Find the user to send the confirmation email to
  $userID = $_SESSION['userID'];
  $db = new PDO("mysql:dbname=coursework; host=localhost","root","");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $userQuery=$db->query("SELECT * FROM user WHERE UserID ='$userID'");
  $user = $userQuery->fetch();

  $userEmail = $user['Email'];
  echo($userEmail);
  $subject = "FiLo System: Request Status Updated";
  $headers = "From the FiLo System admin team.\n";
  $message = "A request you have made has been" . $status . "\n Please log in to see new changes";
  mail($userEmail,$subject,$message,$headers);
}

try{
  //Insert record using form data
  $update=$db->prepare("UPDATE request SET`isApproved`=? WHERE requestedItem=?" );
  $update->execute(array($status, $_GET['id']));
  sendEmail();
  echo "Approved status updated successfully! An email alert has been sent to this user.<p><a href='home.php'>Back</a></p>";
}
catch(PDOException $exception) {
  //Catch exception
  ?>
  <p>Sorry, an error has occured. Please try again, or contact IT services if problems persist.</p>
  <p>Error details: <?= $exception->getMessage(); ?></p>
  <?php
}
 ?>
