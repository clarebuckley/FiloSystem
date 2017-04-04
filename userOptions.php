<?php session_start();
if ($_SESSION['userType'] != "Admin"){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$users=$db->query("SELECT * FROM user");
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
      <h3>Change user details</h3>
    </header>
    <p><a href="home.php">Home</a></br></p>
    <p><a href="admin.php">Back</a></br></p>
    <h3>Users:</h3>
    <form method = "post">
      Order by:
        <select name="orderSelection" >
            <option value="">Change ordering...</option>
             <option value="Surname">Surname</option>
             <option value="Forename">Forename</option>
             <option value="UserType">User type</option>
        </select>
    <input type="submit" name="order" value="Change order" />
    </form>

    <p><table>
      <tr>
        <th>Title</th>
        <th>Forename</th>
        <th>Surname</th>
        <th>Username</th>
        <th>User Type</th>
      </tr>
      <?php
      if($users->rowCount() == 0) { ?>
        <td>There are no users in the system</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      <?php }
      foreach($users as $row){
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
