<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/index.css">
    <title>FiLo System Login</title>
  </head>
  <body>
    <header id = "main-header">
      <h1>Welcome to the FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <header id = "secondary-header">
      <h2>Login:</h2>
    </header>
    <form>
      <p> Username: <input type="text" name="username" size="20" maxlength="20" required /></p>
      <p> Password: <input type="password" name="password" size="20" maxlength="20" required /></p>
      <p><input type="submit" name="submit" value="Submit" /></p>
    </form>
    <section id = "register">
      <p><i>Not registered?</i> <a href="register.php">Make an account</a></p>
      </br>
      <form action="home.php"> <! change this>
        <input type="submit" value="Continue as guest" />
      </form>
    </section>
  </body>
</html>
