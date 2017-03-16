<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/index.css">
    <title>FiLo System Register</title>
  </head>
  <body>
    <h1>Welcome to the FiLo System</h1>
    <p style="text-align: center;"><i>Report or find lost items</i><p>
    </br>
    <p><a href="index.php">Back</a></p>
    <h2>Register a new account:</h2>
    <form>
      <p> Title:
      <select name="title">
			<option value="Mr" selected="selected"> Mr </option>
			<option value="Miss"> Miss </option>
			<option value="Mrs"> Mrs </option>
			<option value="Ms"> Ms </option>
		</select></p>
      <p> Forename: <input type="text" name="forname" size="20" maxlength="20" required /></p>
      <p> Surname: <input type="text" name="surname" size="20" maxlength="20" required /></p>
      <p> Username: <input type="text" name="username" size="20" maxlength="20" required /></p>
      <p> Password: <input type="password" name="password" size="20" maxlength="20" required /></p>
      <p><input type="submit" action="index.php" name="submit" value="Submit" /></p>
    </form>
  </body>
</html>
