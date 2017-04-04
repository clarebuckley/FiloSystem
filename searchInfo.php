<?php session_start();
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$itemID = $_GET['id'];
$query=$db->query("SELECT * FROM item WHERE ItemID = '$itemID'");
$row=$query->fetch();?>

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
      <h3>More information</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>
    <p><a href="search.php">Back</a></br></p>

    <!--Table of found electronics-->
    <h3>More information on this item</h3>
    <p><table>
      <tr>
        <th>Date found</th>
        <th>Found address</th>
        <th>Colour</th>
        <th>Description</th>
        <th>Image</th>
        <?php if($row['Type']=="Electronics"){?>
          <th>Type</th>
          <th>Make</th>
        <?php } if($row['Type']=="Jewellery"){?>
          <th>Type</th>
          <th>Material</th>
        <?php } if($row['Type']=="Pet"){?>
          <th>Name</th>
          <th>Type</th>
          <th>Breed</th>
          <?php } ?>
      </tr>

      <tr><td><?= $row["FoundDate"]?></td>
      <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
      <td><?= $row["Colour"]?></td>
      <td><?= $row["Description"]?></td>
      <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']); ?> width='100' height='100'"/></td>
      <?php
      if($row['Type']=="Electronics"){
        $elecQuery = $db->query("SELECT * FROM electronics WHERE itemID = '$itemID'");
        $elecRow = $elecQuery->fetch();?>
            <td><?= $elecRow["type"]?></td>
            <td><?= $elecRow["make"]?></td>
      <?php }
      if($row['Type']=="Jewellery"){
        $jewelleryQuery = $db->query("SELECT * FROM jewellery WHERE itemID = '$itemID'");
        $jewelleryRow = $jewelleryQuery->fetch();?>
          <td><?= $jewelleryRow["type"]?></td>
          <td><?= $jewelleryRow["materialType"]?></td>
      <?php }
      if($row['Type']=="Pet"){
        $petQuery = $db->query("SELECT * FROM pet WHERE itemID = '$itemID'");
        $petRow = $petQuery->fetch();?>
          <td><?= $petRow["Nype"]?></td>
          <td><?= $petRow["type"]?></td>
          <td><?= $petRow["breed"]?></td>
      <?php }?>
      <td><a href="request.php?id=<?=$itemID?>&page=search" id="request">Request this item</a></td>
      <?php if($_SESSION["userType"] == "Admin"){?>
        <td><a href="editItem.php?id=<?=$itemID?>" id="request">Edit item</a></td>
        </tr>
      <?php } ?>
    </table></p>
    </br>
  </body>
</html>
