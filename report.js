//Adds specific inputs depending on the type of item being recorded
function changedType() {
    if(document.getElementById("type").value == "Jewellery"){
      document.getElementById("specific").innerHTML = "<p>Type of jewellery: "+
      "<select name='jewelleryType' id='jewelleryType'>" +
           "<option value='Earrings'> Earrings </option>" +
           "<option value='Necklace'> Necklace </option>" +
           "<option value='Watch'> Watch </option>" +
           "<option value='Ring'> Ring </option>" +
           "<option value='Bracelet'> Bracelet </option>" +
           "<option value='Other'> Other </option>" +
      "</select></p>" +
      "<p>Material: " +
      "<select name='materialType' id='materialType'>" +
           "<option value='Gold'> Gold </option>" +
           "<option value='Silver'> Silver </option>" +
           "<option value='Fabric'> Fabric </option>" +
           "<option value='Leather'> Leather </option>" +
           "<option value='Other'> Other </option>" +
      "</select></p>";
    }
    if(document.getElementById("type").value == "Electronics"){
      document.getElementById("specific").innerHTML = "<p>Type of electronics: "+
      "<select name='elecType' id='elecType'>" +
           "<option value='Mobile phone'> Mobile phone </option>" +
           "<option value='Tablet'> Tablet </option>" +
           "<option value='Laptop'> Laptop </option>" +
           "<option value='Music player'> Music player </option>" +
           "<option value='Other'> Other </option>" +
      "</select></p>" +
      "<p> Make: <input type='text' name='elecMake' size='20' maxlength='20' required/></p>";
    }
    if(document.getElementById("type").value == "Pet"){
      document.getElementById("specific").innerHTML = "<p> Name: <input type='text' name='name' size='10' maxlength='10' required/></p>"+
      "<p>Type: " +
      "<select name='petType' id='petType;'" +
           "<option value='Dog'> Dog </option>" +
           "<option value='Cat'> Cat </option>" +
           "<option value='Rabbit'> Rabbit </option>" +
           "<option value='Other'> Other </option>" +
      "</select></p>" +
      "<p> Breed: <input type='text' name='breed' size='20' maxlength='20' required/></p>"
    }
}
//Disable the submit button if a type selection hasn't been made
function checkType(){
  if(document.getElementById("type").value == "Please select..."){
    document.getElementById("submit").disabled = true;
  }
  else{
    document.getElementById("submit").disabled = false;
  }
}
