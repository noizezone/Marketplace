<?php
require "header.php";
require 'includes/dbh.inc.php';

if(isset($_SESSION['userUid']) && !empty($_SESSION['userUid'])) {
    $username = $_SESSION['userUid'];
}

?>

<main>

        <section>

    <div class="container">

        <?php
        if(!isset($_SESSION['userId'])) {
            echo '<p class="login-status">You are logged out!</p>';
        }
        else {

            echo "<h2>Edit Contact Info</h2>";
            echo "<p class=\"login-status\">You are logged in, <a href='profile.php'>$username</a>!</p>";

            // Fetch user info -

            $query = "SELECT email, phone_number, city FROM users WHERE username='$username'";
            $result = mysqli_query($conn, $query);

            $rows = mysqli_fetch_assoc($result);

            // header("Refresh:1");

            $initial_email = $rows['email'];
            $initial_phone = $rows['phone_number'];
            $initial_city = $rows['city'];
        }

        ?>

            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-8">
                        <h4>E-mail: </h4><input type="text" name="email" value="<?php echo $initial_email; ?>"> <button id="mail-change" onclick="setTimeout()" type="submit" name="change-email" class="btn btn-dark">Change</button><br><br>
                        <h4>Phone: </h4><input type="text" name="phone" value="<?php echo $initial_phone; ?>"> <button id="phone-change" type="submit" name="change-phone" class="btn btn-dark">Change</button><br><br>
                        <h4>City: </h4><input type="text" name="city" value="<?php echo $initial_city; ?>"> <button id="city-change" type="submit" name="change-city" class="btn btn-dark">Change</button><br><br>

                    </div>
                    <div class="col-sm-1">
                        <a href="profile.php"><button type="submit" name="change-city" class="btn btn-dark">Reload</button></a>
                    </div>

                </div>
            </form>

</div>
        </section>

</main>

<?php


if (isset($_GET['change-email'])){

    if(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_GET['email'];

        $sql = "UPDATE users SET email='$email' WHERE email='$initial_email' AND username='$username'";

        mysqli_query($conn, $sql);

        unset($_GET['change-email']);
        header("Location: profile.php");
    }
    else {
        echo "<p class='warning'> Not a valid email!</p>";
    }

}
if (isset($_GET['change-phone'])){

    $phone = $_GET['phone'];

    $sql = "UPDATE users SET phone_number='$phone' WHERE phone_number='$initial_phone' AND username='$username'";

    mysqli_query($conn, $sql);

    unset($_GET['change-email']);
    header("Location: profile.php");
}
if (isset($_GET['change-city'])){

    $city = $_GET['city'];


    $sql = "UPDATE users SET city='$city' WHERE city='$initial_city' AND username='$username'";

    mysqli_query($conn, $sql);

    unset($_GET['change-email']);
    header("Location: profile.php");
}







?>



<?php
require "footer.php";
?>
