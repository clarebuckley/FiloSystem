<?php session_start();
if (! isset($_SESSION['name'])){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $item=$db->query("SELECT * FROM item WHERE ItemID = '$id'");
}
$user = $_SESSION['userID'];
$request=$db->query("SELECT * FROM request WHERE requestedUser ='$user'");
?>

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
      <h3>Request an item</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>
    <?php  //If the user is making a request for an item, show this table on the page
    if(isset($_GET["page"]) && ($_GET["page"] === "search" || $_GET["page"] === "process")){?>
    <h3>You are requesting:</h3>
    <p><table>
      <tr>
        <th>Date found</th>
        <th>Found address</th>
        <th>Colour</th>
        <th>Description</th>
        <th>Image</th>
      </tr>
      <?php
      foreach($item as $row){
        ?>  <tr><td><?= $row["FoundDate"]?></td>
        <td><?= $row["FoundAddLine1"]?> </br> <?= $row["FoundAddLine2"] ?> </br> <?= $row["FoundPostCode"]?></td>
        <td><?= $row["Colour"]?></td>
        <td><?= $row["Description"]?></td>
        <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Photo']); ?> width='100' height='100'"/></td>
      </tr>
        <?php } ?>
    </table></p>
    <!--Allow the user to submit the request for this item -->
    <form method = "post" action = "requestProcess.php?">
      <p> Reason for request: <input type="text" name="reason" size="40" maxlength="40" required /></p>
      <input type="hidden" name="id" value="<?=$id?>">
      <p><input type="submit" name="submit" value="Request this item" /></p>
    </form>
    <?php }?>

    <!--Show the all of the user's previous requests and whether they've been approved-->
    <h3>Your previous requests status:</h3>
    <p><table>
      <tr>
        <th>Item requested</th>
        <th>Date requested</th>
        <th>Reason</th>
        <th>Approved?</th>
      </tr>
      <?php
      foreach($request as $row){?>
        <?php $thisItemID = $row["requestedItem"];
        $query=$db->query("SELECT * FROM item WHERE ItemID ='$thisItemID'");
        $thisItem = $query->fetch(); ?>
        <tr><td>A <?= $thisItem["Colour"]?> item of type  <?= $thisItem["Type"]?>.</br>Description: <?= $thisItem["Description"]?>.</br>
          <img src="data:image/jpeg;base64,<?php echo base64_encode($thisItem['Photo']); ?> width='100' height='100'"/></td>
        <td><?= $row["dateRequested"]?></td>
        <td><?= $row["reason"]?></td>
        <td><?= $row["isApproved"]?></td>
      </tr>
      <?php }
      if($request->rowCount() == 0) { ?><td>You have not requested any items</td> <?php } ?>
    </table></br></p>

  </body>
</html>
