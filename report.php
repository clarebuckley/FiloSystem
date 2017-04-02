<?php session_start();
if (! isset($_SESSION['name'])){
  header("Location: index.php");
} ?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="report.js"></script>
    <title>FiLo System Register</title>
  </head>
  <body>
    <header id = "main-header">
      <h1>FiLo System</h1>
      <h4><i>Report or find lost items</i></h4>
    </header>
    <header id = "secondary-header">
      <h2>Report a found item:</h2>
    </header>
    <p><a href="home.php">Back</a></p>

    <form method="post" action="reportProcess.php"  enctype="multipart/form-data">
      <p> Type of item:
        <select name="type" onchange="changedType()" id="type">
             <option value="Please select...">Please select...</option>
			       <option value="Jewellery">  Jewellery </option>
			       <option value="Electronics"> Electronics </option>
			       <option value="Pet"> Pet </option>
		    </select></p>
      <p> Date found: <input type="date" name="date" size="10" maxlength="20" required /></p>
      <p><i> Place found: </i></p>
      <p> Address Line 1:<input type="text" name="addline1" size="30" maxlength="30" required /></p>
      <p> Address Line 2:<input type="text" name="addline2" size="30" maxlength="30" required /></p>
      <p> Post code:<input type="text" name="postcode" size="10" maxlength="10" required /></p>
      <p> Colour: <input type="text" name="colour" size="20" maxlength="20" required /></p>
      <p> Photo: <input type="file" name="photo" id="photo" size="20" maxlength="20" required /></p>
      <p> Description: <input type="text" name="description" size="50" maxlength="50" required /></p>

      <!-- Input specific to each item -->
      <div id="specific"></div>
      <p><input type="submit" name="submit" id="submit" value="Submit" onclick="checkType()" /></p>
    </form>

  </body>
</html>
