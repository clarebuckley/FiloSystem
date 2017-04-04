<?php session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$userID = $_GET['id'];
$query=$db->query("SELECT * FROM user WHERE UserID ='$userID'");
$user=$query->fetch();
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <title>FiLo System</title>
  </head>
  <body>
    <header id = "main-header">
      <h1>FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <nav>
         |<a href="home.php" style="color: #FFFFFF;">>Home</a>   |
      <?php if($_SESSION["userType"] == "Admin"){?>
      <a href="admin.php" style="color: #FFFFFF;">>Admin options</a>   |
      <?php } ?>
      <!-- only show if user is signed in -->
      <?php if($_SESSION["userType"] != "Guest"){?>
      <a href="logout.php" style="color: #FFFFFF;">>Log out</a>   |
      <?php } ?>
    </nav>
    <header id = "secondary-header">
      <h3>Edit user <?= $user['Forename'] . " " . $user['Surname']?></h3>
    </header>
    <p><a href="userOptions.php">Back</a></br></p>
    <form method="post" action="editUserProcess.php">
      <p>Title:
        <select name='title' id='title;' value="<?= $user['Title'] ?>">
         <option value='Mr'> Mr </option>
         <option value='Miss'> Miss </option>
         <option value='Mrs'> Mrs </option>
         <option value='Ms'> Ms </option>
        </select></p>
      <p> Forename: <input type='text' name='forename' size='20' maxlength='20' value="<?= $user['Forename'] ?>" required/></p>
      <p> Surname: <input type='text' name='surname' size='20' maxlength='20' value="<?= $user['Surname'] ?>" required/></p>
      <p> Username: <input type='text' name='username' size='10' maxlength='10' value="<?= $user['Username'] ?>" required/></p>
      <p> Password: <input type='password' name='password' size='30' maxlength='50' value="<?= $user['Password'] ?>" required/></p>
      <p> Email: <input type='text' name='email' size='30' maxlength='30' value="<?= $user['Email'] ?>" required/></p>
      <p>User type:
        <select name='userType' id='userType;' value="<?= $user['UserType'] ?>">
         <option value='Admin'> Admin </option>
         <option value='Registered'> Registered </option>
        </select></p>
      <input type='hidden' name='userID' size='10' maxlength='10' value="<?= $user['UserID'] ?>"/></p>
      <input type="submit" name="submit" id="submit" value="Update user data"/></p>
    </form>
  </body>
</html>
