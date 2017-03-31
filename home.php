<?php session_start();
//check if the user is logged in, otherwise redirect to start
if (! isset($_SESSION['name'])){
  header("Location: indexProcess.php");
}?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <title>FiLo System Homepage</title>
  </head>
  <body>

    <header id = "main-header">
      <h1>FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <header id = "secondary-header">
      <h2>Home</h2>
    </header>

    <form action="report.php">
    </br>
      <input type="submit" value="Report a found item" />
    </form>

    <form action="find.html">
      <input type="submit" value="Search for a lost item" />
    </form>
    </br></br>

    <section id = "register">
      </br>
      <form action="index.html">
        <input type="submit" value="Log out" />
      </form>
      <form action="register.php">
        <input type="submit" value="Create an account" />
      </form>
    </section>

  </body>
</html>
