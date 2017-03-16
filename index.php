<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/index.css">
    <title>FiLo System Login</title>
  </head>
  <body>
    <h1>Welcome to the FiLo System</h1>
    <p style="text-align: center;"><i>Report or find lost items</i><p>
    </br>
    <h2>Login:</h2>
    <form>
      <p> Username: <input type="text" name="username" size="20" maxlength="20" required /></p>
      <p> Password: <input type="password" name="password" size="20" maxlength="20" required /></p>
      <p><input type="submit" name="submit" value="Submit" /></p>
    </form>
    <p><i>Not registered?</i> <a href="register.php">Make an account</a></p>
    <form action="http://google.com">
      <input type="submit" value="Continue as guest" />
    </form>
  </body>
</html>
