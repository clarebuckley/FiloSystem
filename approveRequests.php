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
    <header id = "secondary-header">
      <h3>Approve pending requests</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>
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
        ?>  <tr><td>a type </td>
        <td>description here</td>
        <td>picture here</td>
        <td><?= $row["requestedUser"]?></td>
        <td><?= $row["reason"]?></td>
        <td><?= $row["dateRequested"]?></td>
        <td><a href="approveReqProcess.php?id=<?=$row["requestedItem"]?>&option=Approved">Approve this item</a> | <a href="approveReqProcess.php?id=<?=$row["requestedItem"]?>&option=Rejected">Reject this item</a></td>
      </tr>
        <?php } ?>
    </table></p>




  </body>
</html>
