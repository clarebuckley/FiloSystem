<?php session_start();
//this page is visible to all users
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="home.js"></script>
    <title>FiLo System Homepage</title>
  </head>
  <body>

    <header id = "main-header">
      <h1>FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <nav>
      <?php if($_SESSION["userType"] == "Admin"){?>
         |<a href="admin.php" style="color: #FFFFFF;">>Admin options</a>   |
      <?php } ?>
      <!-- only show if user is signed in -->
      <?php if($_SESSION["userType"] != "Guest"){?>
      <a href="logout.php" style="color: #FFFFFF;">>Log out</a>   |
      <?php } ?>
    </nav>
    <header id = "secondary-header">
      <h2>Home</h2>
    </header>

    <!-- only show if user is signed in -->
    <?php if($_SESSION["userType"] != "Guest"){?>
    <form action="report.php">
      </br>
      <input type="submit" value="Report a found item" />
    </form>
    <form action="request.php">
      </br>
      <input type="submit" value="View requested items" />
    </form>
    <?php } ?>

    <form action="search.php">
      </br>
      <input type="submit" value="Search for a lost item" />
    </form>
    </br></br>

    <!-- only show if user is a guest -->
    <?php if($_SESSION["userType"] == "Guest"){?>
    <section id = "register">
      <form action="register.php">
        <input type="submit" value="Create an account" />
      </form>
    </section>
    <?php } ?>
  </body>
</html>
