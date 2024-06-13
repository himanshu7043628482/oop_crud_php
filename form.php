<?php
include ("connection.php");

$hobby = isset($_GET['hobby']) ? $_GET['hobby'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form_Crud_Oop_In_PHP</title>
    <style>
        td {
            border: 1px solid black;
        }

        .Error {
            color: red;
        }
    </style>
    <script>
        function previewImage() {
            var preview = document.getElementById('imagePreview');
            var fileInput = document.getElementById('imageInput');
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
                preview.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
            else {
                preview.src = '<?php echo isset($_GET['image']) ? $_GET['image'] : ''; ?>';
                preview.style.display = 'block';
            }
        }
    </script>
</head>

<body>
    <h2 align="center"><mark>Form_Crud_Oop_In_PHP</mark></h2>
    <form method="post" action="validation.php" enctype="multipart/form-data">
        <table align="center" cellpadding="10">
            <tr>
                <td>Name : <input type="text" placeholder="Enter Name" name="name" value="<?php if (isset($_GET['name'])) {
                    echo $_GET['name'];
                } ?>">
                    <span class="Error"><?php echo isset($_GET["nameErr"]) ? $_GET["nameErr"] : ""; ?></span>
                </td>
            </tr>

            <tr>
                <td>Gender:
                    <input type="radio" name="gender" value="male" <?php echo ($_GET['gender'] ?? '') == 'male' ? 'checked' : ''; ?>>Male
                    <input type="radio" name="gender" value="female" <?php echo ($_GET['gender'] ?? '') == 'female' ? 'checked' : ''; ?>>Female
                    <input type="radio" name="gender" value="other" <?php echo ($_GET['gender'] ?? '') == 'other' ? 'checked' : ''; ?>>Other
                    <span class="Error"><?php echo isset($_GET["GenderErr"]) ? $_GET["GenderErr"] : ""; ?></span>
                </td>
            </tr>

            <tr>
                <td>State : <select name="state">
                        <option value="">Select Your State</option>

                        <option value="Gujarat" <?php if (isset($_GET["state"])) {
                            if ($_GET['state'] == "Gujarat") {
                                echo " selected=\"selected\"";
                            }
                        }
                        ?>>Gujarat</option>

                        <option value="Maharast" <?php if (isset($_GET["state"])) {
                            if ($_GET['state'] == "Maharast") {
                                echo " selected=\"selected\"";
                            }
                        }
                        ?>>Maharast</option>

                        <option value="Goa" <?php if (isset($_GET['state'])) {
                            if ($_GET['state'] == "Goa") {
                                echo " selected=\"selected\"";
                            }
                        }
                        ?>>Goa</option>
                    </select>
                    <span class="Error"><?php echo isset($_GET["stateErr"]) ? $_GET["stateErr"] : ""; ?></span>
                </td>
            </tr>

            <tr>
                <td>Address : <textarea name="address" row="5" cols="40"><?php if (isset($_GET['address'])) {
                    echo $_GET['address'];
                } ?></textarea><span
                        class="Error"><?php echo isset($_GET["addressErr"]) ? $_GET["addressErr"] : ""; ?></span></td>
            </tr>

            <tr>
                <td>Hobbies :
                    <input type="checkbox" name="hobbies[]" value="Gaming" <?php
                    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
                        $hobbies = $_GET['hobby'];
                        foreach ($hobbies as $value) {
                            if ($value == 'Gaming') {
                                echo 'checked';
                            }
                        }
                    } ?>>Gaming

                    <input type="checkbox" name="hobbies[]" value="Music" <?php
                    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
                        $hobbies = $_GET['hobby'];
                        foreach ($hobbies as $value) {
                            if ($value == 'Music') {
                                echo 'checked';
                            }
                        }
                    } ?>>Music

                    <input type="checkbox" name="hobbies[]" value="Movie" <?php
                    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
                        $hobbies = $_GET['hobby'];
                        foreach ($hobbies as $value) {
                            if ($value == 'Movie') {
                                echo 'checked';
                            }
                        }
                    } ?>>Movie

                    <input type="checkbox" name="hobbies[]" value="Working" <?php
                    if (isset($_GET['hobby']) && is_array($_GET['hobby'])) {
                        $hobbies = $_GET['hobby'];
                        foreach ($hobbies as $value) {
                            if ($value == 'Working') {
                                echo 'checked';
                            }
                        }
                    } ?>>Working

                    <input type="checkbox" name="hobbies[]" value="Travelling" <?php
                    if (isset($hobby) && is_array($hobby)) {
                        foreach ($hobby as $value) {
                            if ($value == 'Travelling') {
                                echo 'checked';
                            }
                        }
                    } ?>>Travelling

                    <span class="Error"><?php echo isset($_GET["HobbyErr"]) ? $_GET["HobbyErr"] : ""; ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    Image : <input type="file" name="image" id="imageInput" onchange="previewImage();">
                    <img id="imagePreview" src="<?php echo isset($_GET['image']) ? $_GET['image'] : ''; ?>"
                        alt="Preview" style="display:none; max-width: 100px; max-height: 100px;">
                    <span class="Error"><?php echo isset($_GET["imageErr"]) ? $_GET["imageErr"] : ""; ?></span>
                </td>
            </tr>

            <tr>
                <td align="center">
                    <input type="submit" value="submit" name="submit">
                    &nbsp&nbsp&nbsp
                    <a href=form.php><input type="button" value="Reset" name="Reset"></a>
                    &nbsp&nbsp
                    <a href=display.php><input type="button" value="Display" name="Display"></a>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>