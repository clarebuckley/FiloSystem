<?php session_start();
if ($_SESSION['userType'] != "Admin"){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
      <h3>Change user details</h3>
    </header>
    <p><a href="admin.php">Back</a></br></p>
    <h3>Users:</h3>
    <form method = "post">
      Order by:
        <select name="orderSelection" >
            <option value="Empty">Change ordering...</option>
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
        <th>Email</th>
        <th>User Type</th>
      </tr>
      <?php
      //Change order of rows
      if(isset($_POST["orderSelection"]) && $_POST['orderSelection']!="Empty"){
        $users=$db->query("SELECT * FROM user ORDER BY " . $_POST['orderSelection']);
      }
      else{
        $users=$db->query("SELECT * FROM user");
      }

      if($users->rowCount() == 0) { ?>
        <td>There are no users in the system</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
      <?php }
      foreach($users as $row){
        ?>
        <td><?= $row["Title"]?></td>
        <td><?= $row["Forename"]?></td>
        <td><?= $row["Surname"]?></td>
        <td><?= $row["Username"]?></td>
        <td><?= $row["Email"]?></td>
        <td><?= $row["UserType"]?></td>
        <td><a href="editUser.php?id=<?=$row["UserID"]?>&">Edit user</a></td>
      </tr>
        <?php } ?>
    </table></p>




  </body>
</html>
