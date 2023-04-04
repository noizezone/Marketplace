<?php
require "header.php";
require "./includes/dbh.inc.php";

if(isset($_SESSION['id_prod']) && !empty($_SESSION['id_prod'])) {
    $elem = $_SESSION['id_prod'];
}

//echo $elem;

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
<main>
    <div class="container col-lg-12">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h1 id="signup-title">Edit</h1>
                    </div>
                    <div class="col-sm"></div>
                </div>
            </div>
            <form class="col-sm-6" action="edit.php" method="POST">
                <input class="form-control" type="text" name="change-title" placeholder="Change Title"><br>
                <input class="form-control" type="text" name="change-description" placeholder="Change Description"><br>
                <button class="form-control btn btn-dark" type="submit" name="item-edit">Edit Data</button>
            </form>
        </section>
    </div>
</main>
</body>
</html>


<?php

if(isset($_POST['item-edit'])) {
    if(!empty($_POST['change-title']) && !empty($_POST['change-description'])) {
        $title = $_POST['change-title'];
        $description = $_POST['change-description'];

        if (empty($title) || empty($description)) {
            echo "Fields cannot be empty!";
        } else {
            $sql = "UPDATE items SET title='$title', description='$description' WHERE product_id='$elem'";
            $result = mysqli_query($conn, $sql);

            echo "<p class='signup-sucess'>Item updated!</p>";
            //header("Location: my-items.php");

            echo "<a href='my-items.php'><button type=\"submit\" class=\"btn btn-dark my-3\" name=\"reload\">My Items</button></a>";
        }
    }
    else {
        echo "<p class='warning'>Fields cannot be empty!</p>";
    }


}
?>

