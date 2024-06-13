<html>

<head>
    <title>Display</title>
    <style>
        body {
            background: #D071f9;
        }

        table {
            background-color: #F5F5DC;
            margin: 0 auto;
        }

        .Edit,
        .Delete {
            background-color: green;
            color: white;
            border: 0;
            outline: none;
            border-radius: 5px;
            height: 25px;
            width: 80px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.1s, box-shadow 0.1s;

        }

        .Edit:hover {
            background-color: darkgreen;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .Delete:hover {
            background-color: darkblue;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .btn {
            background-color: green;
            border: 0;
            color: white;
            outline: none;
            border-radius: 8px;
            height: 30px;
            width: 150px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            transition: background-color 0.1s, box-shadow 0.1s;
        }

        .btn:hover {
            background-color: darkgreen;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .Delete {
            background-color: blue;
        }
    </style>
</head>

</html>
<?php
include ("connection.php");
class display extends Connection
{
    function show()
    {
        $query = "SELECT * FROM `oops`";
        $data = mysqli_query($this->conn, $query);
        ?>
        <center><a href=form.php><input type="button" value="INSERT FORM" class="btn" name="INSERT FORM"></a></center>
        <h2 align="center"><mark>Display All Record</mark></h2>

        <center>
            <table border="1" callspacing="" width="100%">
                <tr>
                    <th width="5%">id</th>
                    <th width="10%">Name</th>
                    <th width="10%">Gender</th>
                    <th width="10%">Address</th>
                    <th width="10%">State</th>
                    <th width="20%">Hobby</th>
                    <th width="10%">Image</th>
                    <th width="25%">Operation</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<tr>
            <td style='text-align: center;'>{$row['id']}</td>
            <td style='text-align: center;'>{$row['name']}</td>
            <td style='text-align: center;'>{$row['gender']}</td>
            <td style='text-align: center;'>{$row['address']}</td>
            <td style='text-align: center;'>{$row['state']}</td>
            <td style='text-align: center;'>{$row['hobby']}</td>
            <td style='text-align: center;'><img src='" . $row['image'] . "' height='120px' width='128px'></td>
            <td style='text-align: center;'> &nbsp&nbsp
                <a href='edit_form.php?id={$row['id']}'><input type='submit' value='Edit' class='Edit'></a>
                &nbsp&nbsp
                <a href='delete.php?id={$row['id']}'><input type='submit' value='Delete' class='Delete' onclick='return checkdelete()'></a>
            </td>
          </tr>";
                }
    }
}

$show = new display();
$show->show();
?>
    </table>
</center>
<script>
    function checkdelete() {
        return confirm('Are you sure your want to delete this record?');
    }
</script>