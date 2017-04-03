<?php session_start();
require('searchProcess.php');?>
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
      <h3>Search for a lost item:</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>

    <!--Table of found electronics-->
    <h3>Found electronics</h3>
    <p><table>
      <tr>
        <th>Date found</th>
        <th>Found address</th>
        <th>Colour</th>
        <th>Description</th>
        <th>Image</th>
        <th>Type</th>
        <th>Make</th>
      </tr>

      <?php
      $itemRows=$db->query("SELECT * FROM item WHERE Type = 'Electronics'");
      $itemID;
      foreach($itemRows as $row){
        $itemID = $row["ItemID"];
        ?>  <tr><td><?= $row["FoundDate"]?></td>
        <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
        <td><?= $row["Colour"]?></td>
        <td><?= $row["Description"]?></td>
        <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']); ?> width='100' height='100'"/></td>
        <?php  $elecRows=$db->query("SELECT * FROM electronics WHERE itemID = $itemID");
        foreach ($elecRows as $row) {
          if(($row["itemID"] == $itemID)){ ?>
        <td><?= $row["type"]?></td>
        <td><?= $row["make"]?></td>
        <?php if ($_SESSION["userType"]!="Guest"){?>
        <td><a href="request.php?id=<?=$itemID?>&page=search" id="request">Request this item</a></td>
        <?php } if($_SESSION["userType"] == "Admin"){?>
        <td><a href="editItem.php?id=<?=$itemID?>" id="request">Edit item</a></td>
          </tr>
      <?php }}}} ?>
    </table></p>
    </br>

    <!--Table of found jewellery-->
    <h3>Found jewellery</h3>
    <p><table>
      <tr>
        <th>Date found</th>
        <th>Found address</th>
        <th>Colour</th>
        <th>Description</th>
        <th>Image</th>
        <th>Type</th>
        <th>Material</th>
      </tr>
        <?php
        $itemRows=$db->query("SELECT * FROM item WHERE Type = 'Jewellery'");
        foreach($itemRows as $row){
          $itemID = $row["ItemID"];?>
          <tr><td><?= $row["FoundDate"]?></td>
          <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
          <td><?= $row["Colour"]?></td>
          <td><?= $row["Description"]?></td>
          <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']); ?> width='100' height='100'"/></td>
          <?php
          $jewelleryRows=$db->query("SELECT * FROM jewellery WHERE itemID = $itemID");
          foreach ($jewelleryRows as $row) {?>
          <td><?= $row["type"]?></td>
          <td><?= $row["materialType"]?></td>
          <?php if ($_SESSION["userType"]!="Guest"){?>
          <td><a href="request.php?id=<?=$itemID?>&page=search" id="request">Request this item</a></td>
          <?php } if($_SESSION["userType"] == "Admin"){?>
          <td><a href="editItem.php?id=<?=$itemID?>" id="request">Edit item</a></td>
        </tr>
          <?php }}} ?>
    </table></p>
    </br>

    <!--Table of found pets-->
    <h3>Found pets</h3>
    <p><table>
      <tr>
        <th>Date found</th>
        <th>Found address</th>
        <th>Colour</th>
        <th>Description</th>
        <th>Image</th>
        <th>Name</th>
        <th>Type</th>
        <th>Breed</th>
      </tr>
      <tr>
        <?php
        $itemRows=$db->query("SELECT * FROM item WHERE Type = 'Pet'");
        foreach($itemRows as $row){
          $itemID = $row["ItemID"];?>
          <tr><td><?= $row["FoundDate"]?></td>
          <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
          <td><?= $row["Colour"]?></td>
          <td><?= $row["Description"]?></td>
          <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']); ?> width='100' height='100'"/></td>
          <?php
          $petRows=$db->query("SELECT * FROM pet WHERE itemID = $itemID");
          foreach ($petRows as $row) {?>
          <td><?= $row["Name"]?></td>
          <td><?= $row["type"]?></td>
          <td><?= $row["breed"]?></td>
          <?php if ($_SESSION["userType"]!="Guest"){?>
          <td><a href="request.php?id=<?=$itemID?>&page=search" id="request">Request this item</a></td>
          <?php } if($_SESSION["userType"] == "Admin"){?>
          <td><a href="editItem.php?id=<?=$itemID?>" id="request">Edit item</a></td>
        </tr>
          <?php }}} ?>
    </table></p>

  </body>
</html>
