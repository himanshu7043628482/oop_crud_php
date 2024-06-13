<?php
include("connection.php");
class Edit_form extends Connection {
    public function edit() {
        $row = [];
        $id = isset($_GET['id']) ? $_GET['id'] : (isset($_GET['userid']) ? $_GET['userid'] : null);
        if ($id) {
            $query = "SELECT * FROM `oops` WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        }
        return $row;
    }
}

 $obj = new Edit_form();
 $row = $obj->edit();

 $hobby = isset($_GET['hobby']) ? $_GET['hobby'] : '';
 $hobby1 = isset($row['hobby']) ? $row['hobby'] : '';
 $Hobby1 = explode(",",$hobby1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Edit In PHP </title>
     <style>
         td{
           border: 1px solid black;
       }
       .Error{
        color:red;
       }
      </style>
    </head>
    <body>
        <h2 align="center"><mark>Form Edit In PHP</mark></h2>

        <form method ="post" action="update.php" enctype="multipart/form-data">
        <table  align="center" cellpadding="10">
 
         <tr>
         <td>Name : <input type="text" placeholder="Enter Name" name="name" value="<?php 
            if (isset($_GET["id"])) {
                if (isset($row["name"]))  {
                    echo $row['name'];
                }
            }
                if(isset($_GET['name'])) {
                    echo $_GET['name'];
                }
            ?>">
         <span class="Error"><?php echo isset($_GET["nameErr"]) ? $_GET["nameErr"] : "";?></span></td>
         </tr>
 
        <tr>
     <td>Gender:
        <input type="radio" name="gender" value="male"<?php 
        if (isset($_GET["id"])) {
        echo ($row['gender'] ?? '') == 'male' ? 'checked' : '';
        }
        echo ($_GET['gender'] ?? '') == 'male' ? 'checked' : '';
        ?>>Male

        <input type="radio" name="gender" value="female"<?php
        if (isset($_GET['id'])) {
         echo ($row['gender'] ?? '') == 'female' ? 'checked' : '';
        }
        echo ($_GET['gender'] ?? '') == 'female' ? 'checked' : '';
        ?>>Female

        <input type="radio" name="gender" value="other"<?php
        if (isset($_GET['id'])) {
         echo ($row['gender'] ?? '') == 'other' ? 'checked' : '';
        }
        echo ($_GET['gender'] ?? '') == 'other' ? 'checked' : '';
        ?>>Other

        <span class="Error"><?php echo isset($_GET["GenderErr"]) ? $_GET["GenderErr"] : "";?></span>
     </td>
    </tr>

<tr>
    <td>State : <select name="state">
        <option value="">Select Your state</option>
        <option value="Gujarat"<?php
        if (isset($_GET["id"])) {
         if(isset($row["state"])){
            if($row['state'] == "Gujarat"){
                echo " selected=\"selected\"";
            }
         } 
        }
         if(isset($_GET["state"])){
            if($_GET['state'] == "Gujarat"){
                echo " selected=\"selected\"";
            }
         } 
         ?>>Gujarat</option>

        <option value="Maharast"<?php
         if (isset($_GET["id"])) {
            if(isset($row["state"])){
               if($row['state'] == "Maharast"){
                   echo " selected=\"selected\"";
               }
            } 
           }
            if(isset($_GET["state"])){
               if($_GET['state'] == "Maharast"){
                   echo " selected=\"selected\"";
               }
            } 
         ?>>Maharast</option>
                 
        <option value="Goa"<?php
         if (isset($_GET["id"])) {
            if(isset($row["state"])){
               if($row['state'] == "Goa"){
                   echo " selected=\"selected\"";
               }
            } 
           }
            if(isset($_GET["state"])){
               if($_GET['state'] == "Goa"){
                   echo " selected=\"selected\"";
               }
            } 
         ?>>Goa</option>
    </select>
    <span class="Error"><?php echo isset($_GET["stateErr"]) ? $_GET["stateErr"] : "";?></span>
</td>
</tr>
 
<tr>
    <td>Address: <textarea name="address" rows="3" cols="40"><?php
        if (isset($_GET["id"])) {
            if (isset($row["address"]))  {
                echo $row['address'];
            }
        }
        if(isset($_GET['address'])) {
                echo $_GET['address'];
        }
        ?></textarea><span class="Error"><?php echo isset($_GET["addressErr"]) ? $_GET["addressErr"] : "";?></span></td>
</tr>
 
    <tr>
        <td>Hobbies :
        <input type="checkbox" name="hobbies[]" value="Gaming"<?php
         if (isset($_GET["id"])) {
        if (isset($Hobby1) && $Hobby1 != "") {
            foreach ($Hobby1 as $value) {
                if ($value == 'Gaming') {
                    echo 'checked';
                }
            }
        }
    }
        if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
            $hobbies = $_GET['hobby'];
            foreach ($hobbies as $value) {
                if ($value == 'Gaming') {
                    echo 'checked';
                }
            }
        }?>>Gaming

        <input type="checkbox" name="hobbies[]" value="Music"<?php
         if (isset($_GET["id"])) {
        if (isset($Hobby1) && $Hobby1 != '') {
            foreach ($Hobby1 as $value) {
                if ($value == 'Music') {
                    echo 'checked';
                }
            }
        }
    }
    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
        $hobbies = $_GET['hobby'];
        foreach ($hobbies as $value) {
            if ($value == 'Music') {
               echo 'checked';
            }
        }
    }?>>Music

        <input type="checkbox" name="hobbies[]" value="Movie" <?php
         if (isset($_GET["id"])) {
        if (isset($Hobby1) && $Hobby1 != '') {
            foreach ($Hobby1 as $value) {
                if ($value == 'Movie') {
                    echo 'checked';
                }
            }
        }
    }
    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
        $hobbies = $_GET['hobby'];
        foreach ($hobbies as $value) {
            if ($value == 'Movie') {
               echo 'checked';
            }
        }
    }?>>Movie

        <input type="checkbox" name="hobbies[]" value="Working"<?php
         if (isset($_GET["id"])) {
        if (isset($Hobby1) && $Hobby1 != '') {
            foreach ($Hobby1 as $value) {
                if ($value == 'Working') {
                    echo 'checked';
                }
            }
        }
    }
    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
        $hobbies = $_GET['hobby'];
        foreach ($hobbies as $value) {
            if ($value == 'Working') {
                echo 'checked';
             }
        }
    }?>>Working

        <input type="checkbox" name="hobbies[]" value="Travelling" <?php
         if (isset($_GET["id"])) {
        if (isset($Hobby1) && $Hobby1 != '') {
            foreach ($Hobby1 as $value) {
                if ($value == 'Travelling') {
                    echo 'checked';
                }
            }
        }
    }
    if (isset($hobby) && is_array($hobby)) {
        foreach ($hobby as $value) {
            if ($value == 'Travelling') {
                echo 'checked';
            }
        }
    }?>>Travelling 
    <span class="Error"><?php echo isset($_GET["HobbyErr"]) ? $_GET["HobbyErr"] : "";?></span>
    </td>
        </tr>
        
        <tr>
            <td>
                Image : <input type="file" name="image">
                <img src="<?php echo isset($row["image"]) ? $row["image"] : "";?>" style="max-width: 100px; max-height: 100px;">
            </td>
        </tr>
 
        <tr>
        <td align="center">
        <input type="submit" value="Update" name="Update">
        &nbsp&nbsp&nbsp
        <a href=form.php><input type="button" value="INSERT FORM" name="INSERT FORM"></a>
        &nbsp&nbsp
        <a href=edit_form.php><input type="button" value="Reset" name="Reset"></a>
        &nbsp&nbsp
        <a href=display.php><input type="button" value="Display" name="Display"></a>
        <input type="hidden" name="id" value="<?php 
        if(isset($_GET['id'])){
            echo $_GET['id'];
        }
        elseif(isset($_GET['userid'])){
            $id = $_GET['userid'];
            echo $id;
        }
        ?>">
    </td>
    </tr>
</table>  
</form>
</body>
</html>