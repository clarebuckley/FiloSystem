<?php session_start();
//Redirect non-admin users
if ($_SESSION['userType'] != "Admin"){
  header("Location: index.php");
}
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
    <header id = "secondary-header">
      <h3>Admin options</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>

    <form action="approveRequests.php">
      </br>
      <input type="submit" value="Approve requests" />
    </form>

    <form action="userOptions.php">
      </br>
      <input type="submit" value="User options" />
    </form>

    <form action="search.php">
      </br>
      <input type="submit" value="Edit item details" />
    </form>

  </body>
</html>
