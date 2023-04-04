<?php
session_start();
require 'dbh.inc.php';
$msg = "";


$sql = "SELECT product_id FROM items WHERE product_id = (SELECT MAX(product_id) FROM items)";

$result = mysqli_query($conn, $sql);

if (!$result) {
    echo 'Could not run query: ' . mysqli_error();
    exit;
}

$row = mysqli_fetch_row($result);


if(isset($_SESSION['userUid']) && !empty($_SESSION['userUid'])) {
    $username = $_SESSION['userUid'];
}
if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    $userid = $_SESSION['userId'];
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Upload image</h2>
</body>
</html>

<?php


if (isset($_POST['item-submit'])) {

    if (!isset($_SESSION['userId'])) {
        echo '<p class="login-status">You are logged out!</p>';
    } else {
        echo "<p class=\"login-status\">You are logged in, <a href='profile.php'>$username</a>!</p>";
    }

    $title = $_POST['title'];
    $description = $_POST['description'];


    if (empty($title) || empty($description)) {
        echo "Fields cannot be empty!";
    } else {
        $sql = "INSERT INTO items(id_user, title, description) VALUES ('$userid','$title','$description')";
        $result = mysqli_query($conn, $sql);

        //insert image with the last product id (last added item)
       // $last_id = mysqli_insert_id($conn);

        echo "Item added successfully!";
        header("Location: insert.inc.php");
    }



}



?>


    <!DOCTYPE html>
    <html>

    <head>
        <title>Image Upload</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../style-upload.css">
    </head>

    <body>
    <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
    <div id="display-image">
        <?php
        $query = "select * from images where product_id='$row[0]'";
        $result = mysqli_query($conn, $query);

        while ($data = mysqli_fetch_assoc($result)) {
            ?>
            <img class= "show-added-images" src="../uploads/<?php echo $data['location']; ?>">

            <?php
        }
        ?>
    </div>

    <a href="../insert.php"><button type="button" name="back-add-item" class="btn btn-dark">Add another Item</button></a>
    <a href="../index.php"><button type="button" name="home" class="btn btn-dark">Home</button></a>
    </body>

    </html>

<?php



$msg = "";



// If upload button is clicked ...
if (isset($_POST['upload'])) {



    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "../uploads/" . $filename;

    // Get all the submitted data from the form
    $sql = "INSERT INTO images (product_id,location) VALUES ('$row[0]','$filename')";

    // Execute query
    mysqli_query($conn, $sql);

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        echo "<h3>  Image uploaded successfully!</h3>";
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }

 header("Location: insert.inc.php");
}
?>



