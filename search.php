<?php session_start();
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);;
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="search.js"></script>
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
      <h3>Search for a lost item:</h3>
    </header>
    <p><a href="home.php">Back</a></br></p>

    <h3>Found items</h3>
    <!-- Option to order items by headers -->
    <form method = "post">
      Order by:
        <select name="orderSelection" >
            <option value="Empty">Change ordering...</option>
			       <option value="Type">Type of item</option>
			       <option value="FoundDate">Date found</option>
		    </select>
    <input type="submit" name="order" value="Change order" />
    </form>

    <!--Table of all found items-->
    <p><table>
      <tr>
        <th>Type of item</th>
        <th>Date found</th>
        <th>Found address</th>
      </tr>

      <?php
      //Change order of rows
      if(isset($_POST["orderSelection"]) && $_POST['orderSelection']!="Empty"){
        echo ("Selection:" .$_POST['orderSelection']);
        $itemRows=$db->query("SELECT * FROM item ORDER BY " . $_POST['orderSelection']);
      } else {
        $itemRows=$db->query("SELECT * FROM item");
      }

      foreach($itemRows as $row){
        $itemID = $row["ItemID"];
        $query=$db->query("SELECT * FROM request WHERE requestedItem ='$itemID'");
        $itemRequest=$query->fetch();
        if($itemRequest['isApproved']!="Approved"){
        ?>  <tr>
        <td><?= $row["Type"]?></td>
        <td><?= $row["FoundDate"]?></td>
        <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
        <?php if($_SESSION["userType"]!="Guest"){?>
        <td><a href="searchInfo.php?id=<?=$itemID?>" id="info">More information</a></td>
        <?php } ?>
        <tr>
        <?php }} ?>
    </table></p>
    </br>

  </body>
</html>
