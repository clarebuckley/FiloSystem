<?php session_start();
//anyone can view this page?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <title>FiLo System Register</title>
  </head>
  <body>
    <header id = "main-header">
      <h1>Welcome to the FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <header id = "secondary-header">
      <h2>Register a new account:</h2>
    </header>
    <p><a href="index.php">Back</a></p>
    <form method = "post" action = "registerProcess.php">
      <p> Title:
      <select name="title">
			<option value="Mr" selected="selected"> Mr </option>
			<option value="Miss"> Miss </option>
			<option value="Mrs"> Mrs </option>
			<option value="Ms"> Ms </option>
		</select></p>
      <p> Forename: <input type="text" name="forename" size="20" maxlength="20" required /></p>
      <p> Surname: <input type="text" name="surname" size="20" maxlength="20" required /></p>
      <p> Email: <input type="email" name="email" size="30" maxlength="30" required /></p>        <!which version of html am i using>
      <p> Username: <input type="text" name="username" size="20" maxlength="20" required /></p>
      <p> Password: <input type="password" name="password" size="20" maxlength="20" required /></p>
      <p><input type="submit" action="home.php" name="submit" value="Register" /></p>
    </form>
  </body>
</html>
