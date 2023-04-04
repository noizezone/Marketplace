<?php
require "header.php";
require "includes/dbh.inc.php";
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Items</h1>
    <div class="row text-center py-5">

        <?php


        if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
            $userid = $_SESSION['userId'];
        }

        $sql = "SELECT * FROM items WHERE id_user='$userid'";

        $result = mysqli_query($conn, $sql);


        while ($row = mysqli_fetch_assoc($result)) {

            $query = "select location from images where product_id= {$row['product_id']}";
            $result_2 = mysqli_query($conn, $query);
            $data = mysqli_fetch_assoc($result_2);
            $product_img = $data['location'];
            $title = $row['title'];
            $description = $row['description'];
            $publication_date = $row['publication_date'];
            $productid = $row['product_id'];

            echo "

 <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img id='index-images' src=\"uploads/$product_img\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$title</h5>
                                    <p class=\"card-text\">
                                    <span class=\"price\">$description</span>
                                    </p>
                                    <p><b>Date:</b> $publication_date</p>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                    
                        <a href='edit.php'><button type=\"submit\" class=\"btn btn-dark my-3\" name=\"edit\">Edit</button></a>
                        
                      
               
                        <a href='my-items.php'><button type=\"submit\" class=\"btn btn-danger my-3\" name=\"delete\">Delete</button></a>
                </form>
            </div>
</div>
";

            $_SESSION['id_prod'] = $productid;

            if(isset($_POST['edit'])) {
                header("Location: edit.php");
            }
        }

        if(isset($_POST['delete'])) {
            $sql = "DELETE FROM items WHERE product_id='$productid'";
            $result = mysqli_query($conn, $sql);

            echo "<p class='warning'>Item deleted successfully!</p>";
            unset($_POST['delete']);
            echo "<a href='my-items.php'><button type=\"submit\" class=\"btn btn-dark my-3\" name=\"reload\">Reload<i class=\"fas fa-shopping-cart\"></i></button></a>";

        }


        ?>
    </div>
</div>
</body>
</html>


