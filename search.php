<?php session_start();
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <header id = "secondary-header">
      <h3>Search for a lost item:</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>

    <!--Table all found items-->
    <h3>Found items</h3>
    <p><table>
      <tr>
        <th>Type of item</th>
        <th>Date found</th>
        <th>Found address</th>
      </tr>

      <?php
      $itemRows=$db->query("SELECT * FROM item");
      $itemID;
      foreach($itemRows as $row){
        $itemID = $row["ItemID"];
        ?>  <tr>
        <td><?= $row["Type"]?></td>
        <td><?= $row["FoundDate"]?></td>
        <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
        <?php if($_SESSION["userType"]!="Guest"){?>
        <td><a href="searchInfo.php?id=<?=$itemID?>" id="info">More information</a></td>
        <?php } ?>
        <tr>
        <?php } ?>
    </table></p>
    </br>

  </body>
</html>
