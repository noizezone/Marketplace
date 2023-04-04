<?php
require "header.php";

?>

<main>
    <div class="container col-lg-12">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h1 id="signup-title">Signup</h1>
                        <?php

                        if (isset($_GET['error'])) {
                            if($_GET['error'] == "emptyfields") {
                                echo '<p class="signup-error"><b>Fill in all fields!</b></p>';
                            }
                            else if (($_GET['error']) == "invalidmailuid") {
                                echo '<p class="signup-error"><b>Invalid username and email!</b></p>';
                            }
                            else if (($_GET['error']) == "invaliduid") {
                                echo '<p class="signup-error"><b>Invalid username!</b></p>';
                            }
                            else if (($_GET['error']) == "invalidmail") {
                                echo '<p class="signup-error"><b>Invalid e-mail!</b></p>';
                            }
                            else if (($_GET['error']) == "passwordcheck") {
                                echo '<p class="signup-error"><b>Your passwords do not match!</b></p>';
                            }
                            else if (($_GET['error']) == "usertaken") {
                                echo '<p class="signup-error"><b>Username is already taken!</b></p>';
                            }
                        }
                        else if (isset($_GET['signup']) == "success") {
                            echo '<p class="signup-sucess"><b>Signup successful!</b></p>';
                        }
                        ?>

                    </div>
                    <div class="col-sm"></div>
                </div>
            </div>
            <form class="col-sm-6" action="includes/signup.inc.php" method="post">
                <input class="form-control" type="text" name="first-name" placeholder="First Name"><br>
                <input class="form-control" type="text" name="surname" placeholder="Surname"><br>
                <input class="form-control" type="text" name="uid" placeholder="Username"><br>
                <input class="form-control" type="password" name="pwd" placeholder="Password"><br>
                <input class="form-control" type="password" name="pwd-repeat" placeholder="Repeat password"><br>
                <input class="form-control" type="text" name="mail" placeholder="E-mail"><br>
                <input class="form-control" type="text" name="phone-number" placeholder="Phone Number"><br>
                <input class="form-control" type="text" name="city" placeholder="City"><br>
                <button class="form-control btn btn-dark" type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>


<?php
require_once "footer.php";
?>
