<?php 
include("connection.php");
class delete extends Connection{

    function delete(){
        $id = $_GET['id'];

        $query = "DELETE FROM `oops` WHERE id = '$id'";
        $data = mysqli_query($this->conn,$query);

        if($data){
            header("location:display.php");
        }
        else{
            echo "Failed To Delete";
        }
    }
}
$object = new Delete();
$object->delete();
?>