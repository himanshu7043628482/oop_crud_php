<?php
include("connection.php");
class Valid extends Connection{
    public $error = "";
    public $value = "";
    function new(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(empty($_POST["name"])) {
                $this->error .= "&nameErr=**Please_Fill_The_Name";
            }
            else{
                $name = $_POST["name"];
                $this->value .= "&name=$name";
            }

            if(empty($_POST["gender"])) {
                $this->error .= "&GenderErr=**Please_Select_Anyone";
            }
            else{
              $gender = $_POST["gender"];
              $this->value .= "&gender=$gender";
            }

            if(empty($_POST["state"])) {
                $this->error .= "&stateErr=**Please_Select_The_State";
            }
            else{
                $state =$_POST["state"];
                $this->value .= "&state=$state";
            }

            if(empty($_POST["address"])) {
                $this->error .= "&addressErr=**Please_Fill_TheAddress";
            }
            else{
                $address = $_POST["address"];
                $this->value .= "&Address=$address";
            }

            if (isset($_POST["hobbies"])) {
                $hobbyArray = $_POST["hobbies"];
             }
             if (empty($hobbyArray)) {
                $this->error .= "&HobbyErr=**Please_Select_Checkbox";
             }
             $hob="";
             if (!empty($_POST["hobbies"])) {
                foreach ($hobbyArray as $key => $value) {
                    $hob.= '&hobby[' . $key . ']=' . $value;
                }

                $hob_checked = count($_POST["hobbies"]);
                if ($hob_checked < 2) {
                    $this->error .= "&HobbyErr=**minimum_tow_Select_Checkbox";
                }

                if ($hob_checked > 4) {
                    $this->error .= "&HobbyErr=**meximum_four_Select_Checkbox";
                }
            }

            $this->value .="&hobby=$hob"; 
            if(!empty($_FILES["image"]["name"])) {
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];
                $path = "upload/".$filename;
          
                move_uploaded_file($tempname, $path);
                $this->value.="&image = $path";
            }
            else{
                 $this->error .="&imageErr=**Please_Select_Image";
             }

            if ($this->error != "") {
                header("location:form.php?" . $this->error . $this->value . "");
            }

             else {
                if (isset($_POST["submit"])) {
                    if (!empty($hobbyArray)) {
                        $Hobby = implode(',', $hobbyArray);
                     }
                    $query = "INSERT INTO `oops`(`name`,`gender`,`state`,`address`,`hobby`,`image`)VALUE('$name','$gender','$state','$address','$Hobby','$path')";

                    $data = mysqli_query($this->conn, $query);
                    header("location:display.php");
                }
            }
        }
    }
}
$newvar = new Valid();
$newvar->new();