<?php session_start();
if (! isset($_SESSION['name'])){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $item=$db->query("SELECT * FROM item WHERE ItemID = '$id'");
}?>
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
    <p><a href="search.php">Back</a></br></p>
    <?php if(isset($_GET["page"]) && ($_GET["page"] === "search")){?>
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
    <form method = "post" action = "requestProcess.php?">
      <p> Reason for request: <input type="text" name="reason" size="40" maxlength="40" required /></p>
      <input type="hidden" name="id" value="<?=$id?>">
      <p><input type="submit" name="submit" value="Request this item" /></p>
    </form>
    <?php }?>

    <h3>Your previous requests status:</h3>


  </body>
</html>
