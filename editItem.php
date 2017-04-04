<?php session_start();
if ($_SESSION['userType']!="Admin"){
  header("Location: index.php");
}
$db = new PDO("mysql:dbname=coursework; host=localhost","root","");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$itemID = $_GET['id'];
$query=$db->query("SELECT * FROM item WHERE ItemID ='$itemID'");
$item=$query->fetch();
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
      <h3>Edit item details</h3>
    </header>
    <p><a href="search.php">Back</a></br></p>
    <form method="post" action="editItemProcess.php"  enctype="multipart/form-data">
    <p> Type of item:
      <select name="type" onchange="changedType()" id="type" value="<?= $item['Type'] ?>">
           <option value="Jewellery">  Jewellery </option>
           <option value="Electronics"> Electronics </option>
           <option value="Pet"> Pet </option>
      </select></p>
      <p> Date found: <input type="date" name="date" size="10" maxlength="20" value="<?= $item['FoundDate'] ?>" required /></p>
      <p><i> Place found: </i></p>
      <p> Address Line 1:<input type="text" name="addline1" size="30" maxlength="30" value="<?= $item['FoundAddLine1'] ?>" required /></p>
      <p> Address Line 2:<input type="text" name="addline2" size="30" maxlength="30" value="<?= $item['FoundAddLine2'] ?>"required /></p>
      <p> Post code:<input type="text" name="postcode" size="10" maxlength="10" value="<?= $item['FoundPostCode'] ?>" required /></p>
      <p> Colour: <input type="text" name="colour" size="20" maxlength="20" value="<?= $item['Colour'] ?>" required /></p>
      <p> Photo: <input type="file" name="photo" id="photo" size="20" maxlength="20" value="<?= $item['Photo'] ?>" required /></p>
      <p> Description: <input type="text" name="description" size="50" maxlength="50" value="<?= $item['Description'] ?>" required /></p>

      <?php if( $item['Type'] == "Jewellery") {
        $query=$db->query("SELECT * FROM jewellery WHERE itemID ='$itemID'");
        $item=$query->fetch(); ?>
        <p>Type of jewellery:
        <select name='jewelleryType' id='jewelleryType' value="<?= $item['type']?>">
             <option value='Earrings'> Earrings </option>
             <option value='Necklace'> Necklace </option>
             <option value='Watch'> Watch </option>
             <option value='Ring'> Ring </option>
             <option value='Bracelet'> Bracelet </option>
             <option value='Other'> Other </option>
        </select></p>
        <p>Material:
        <select name='materialType' id='materialType' value="<?= $item['materialType'] ?>" >
             <option value='Gold'> Gold </option>
             <option value='Silver'> Silver </option>
             <option value='Fabric'> Fabric </option>
             <option value='Leather'> Leather </option>
             <option value='Other'> Other </option>
        </select></p>
      <?php }else {

      if($item['Type'] == "Electronics") {
        $query=$db->query("SELECT * FROM electronics WHERE itemID ='$itemID'");
        $item=$query->fetch(); ?>
        <p>Type of electronics:
        <select name='elecType' id='elecType' value="<?= $item['type'] ?>"=>
             <option value='Mobile phone'> Mobile phone </option>
             <option value='Tablet'> Tablet </option>
             <option value='Laptop'> Laptop </option>
             <option value='Music player'> Music player </option>
             <option value='Other'> Other </option>
        </select></p>
        <p> Make: <input type='text' name='elecMake' size='20' maxlength='20' value="<?= $item['make'] ?>" required/></p>
      <?php } else{

        if($item['Type'] == "Pet") {
          $query=$db->query("SELECT * FROM pet WHERE itemID ='$itemID'");
          $item=$query->fetch(); ?>
          <p> Name: <input type='text' name='name' size='10' maxlength='10' value="<?= $item['Name'] ?>" required/></p>
          <p>Type:
          <select name='petType' id='petType;' value="<?= $item['type'] ?>"
               <option value='Dog'> Dog </option>
               <option value='Cat'> Cat </option>
               <option value='Rabbit'> Rabbit </option>
               <option value='Other'> Other </option>
          </select></p>
          <p> Breed: <input type='text' name='breed' size='20' maxlength='20' value="<?= $item['breed'] ?>" required/></p>
      <?php }}} ?>
      <input type="hidden" value="<?=$itemID?>" name="itemID" />
      <input type="submit" name="submit" id="submit" value="Change item data"/></p>
    </form>
  </body>
</html>
