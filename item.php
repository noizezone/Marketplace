<?php
require "header.php";
require "includes/dbh.inc.php";
require "component.php";

if(isset($_POST['product_id']) && !empty($_POST['product_id'])) {
    $id_prod = $_POST['product_id'];
}



$sql = "SELECT title, description, publication_date FROM items WHERE product_id='$id_prod'";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {

    $sql = "SELECT * FROM items WHERE product_id='$id_prod'";

    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $query = "select location from images where product_id= {$row['product_id']}";
        $result_2 = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result_2);

        component($row['product_id'], $row['title'], $row['description'], $row['publication_date'], $data['location']);

    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="hide.css">
</head>
<body>
<h3><br><br>Seller Contact Info:</h3>


<?php


if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {

    $uid = isset($_SESSION['userId']);


$sql = "SELECT first_name, surname, email, phone_number, city FROM users WHERE id_user='$uid'";

$result = mysqli_query($conn, $sql);



while ($row = mysqli_fetch_assoc($result)) {

    echo "<h5>First name:</h5>" . $row['first_name']."<br><br>";
    echo "<h5>Surname:</h5>" . $row['surname']."<br><br>";
    echo "<h5>Email:</h5>" . $row['email']."<br><br>";
    echo "<h5>Phone:</h5> " . $row['phone_number'] ."<br><br>";
    echo "<h5>City: </h5>" . $row['city']."<br><br>";
}
}
else {
    echo "You have to be logged in!";
}
?>

<a href=index.php><button type="submit" class="btn btn-dark my-3" name="home">Go Home</button></a>


</body>
</html>
