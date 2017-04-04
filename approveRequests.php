<?php session_start();
if ($_SESSION['userType'] != "Admin"){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$requests=$db->query("SELECT * FROM request WHERE isApproved ='Pending'");

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
      <h3>Approve pending requests</h3>
    </header>
    <p><a href="admin.php">Back</a></br></p>
    <h3>Current requests:</h3>
    <p><table>
      <tr>
        <th>Item type</th>
        <th>Description</th>
        <th>Image</th>
        <th>Requested by</th>
        <th>Reason</th>
        <th>Date requested</th>
        <th>Approve</th>
      </tr>
      <?php
      if($requests->rowCount() == 0) { ?>
        <td>There are no pending requests</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td><?php }
      foreach($requests as $row){
        $itemID=$row['requestedItem'];
        $itemQuery=$db->query("SELECT * FROM item WHERE ItemID = '$itemID'");
        $item=$itemQuery->fetch();
        ?>  <tr><td><?= $item["Type"]?></td>
        <td><?= $item["Description"]?></td>
        <td><?= $item["Photo"]?></td>
        <td><?= $row["requestedUser"]?></td>
        <td><?= $row["reason"]?></td>
        <td><?= $row["dateRequested"]?></td>
        <td><a href="approveReqProcess.php?id=<?=$row["requestedItem"]?>&option=Approved">Approve this item</a> | <a href="approveReqProcess.php?id=<?=$row["requestedItem"]?>&option=Rejected">Reject this item</a></td>
      </tr>
        <?php } ?>
    </table></p>




  </body>
</html>
