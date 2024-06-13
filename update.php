<?php

include("connection.php");
class edit_Valid extends Connection{
    public $userid;
    public $new;
    public $error = "";
    public $Value = "";

    public function __construct(){
        parent::__construct();
        if (isset($_POST["id"])) {
            $this->userid = $_POST["id"];
            $this->new = 'edit_form.php?&userid=' . $this->userid;
        }
    }
    public function new(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (empty($_POST["name"])) {
                $this->error .= "&nameErr=**Please_Fill_The_Name";
            }
             else {
                $name = $_POST["name"];
                $this->Value .= "&name=$name";
            }

            if (empty($_POST["gender"])) {
                $this->error .= "&GenderErr=**Please_Select_Anyone";
            }
             else {
                $gender = $_POST["gender"];
                $this->Value .= "&gender=$gender";
            }

            if (empty($_POST["state"])) {
                $this->error .= "&stateErr=**Please_Select_The_State";
            }
             else {
                $state = $_POST["state"];
                $this->Value .= "&state=$state";
            }

            if (empty($_POST["address"])) {
                $this->error .= "&addressErr=**Please_Fill_The_Address";
            } 
            else {
                $address = $_POST["address"];
                $this->Value .= "&address=$address";
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
            $this->Value .="&hobby=$hob";
            
            if (!empty($_FILES["image"]["name"])) {
                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];
                $path = "upload/" . $filename;
        
                move_uploaded_file($tempname, $path);
            }
            if ($this->error != "") {
                header("location:$this->new" . $this->error . $this->Value);
            }
             else {
                if (isset($_POST["Update"])) {
                    $query= "";
                    if (!empty($hobbyArray)) {
                        $Hobby = implode(',', $hobbyArray);
                     }
                    $query = "UPDATE `oops` SET `name`='$name', `gender`='$gender', `state`='$state', `address`='$address',`hobby`='$Hobby'";
                    if($path) {
                        $query .= ",`image`='$path'";
                }
                    $query .= " WHERE `id`='$this->userid'";
                    $result = mysqli_query($this->conn, $query);

                    if ($result) {
                        header("location:display.php");
                    }
                     else {
                        echo "Error updating record:" . mysqli_error($this->conn);
                    }
                }
            }
        }
    }
}
$newvar = new edit_Valid();
$newvar->new();