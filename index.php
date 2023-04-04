<?php
require "header.php";
require 'includes/dbh.inc.php';
require_once ('component.php');


if(isset($_SESSION['userUid']) && !empty($_SESSION['userUid'])) {
    $username = $_SESSION['userUid'];
}

?>

<main>
    <div class="wrapper-main">
   <section>
       <?php
       if(isset($_SESSION['userId'])) {
           echo "<p class=\"login-status\">You are logged in, <a href='profile.php'>$username</a>!</p>";

       }
       else {
           echo '<p class="login-status">You are logged out!</p>';
       }

       ?>

       <div class="container">
           <h1>Items</h1>
           <div class="row text-center py-5">

               <?php


               $sql = "SELECT * FROM items";

               $result = mysqli_query($conn, $sql);

               while ($row = mysqli_fetch_assoc($result)) {

                   $query = "select location from images where product_id= {$row['product_id']}";
                   $result_2 = mysqli_query($conn, $query);
                   $data = mysqli_fetch_assoc($result_2);

                   component($row['product_id'], $row['title'], $row['description'], $row['publication_date'], $data['location']);

               }
               ?>
           </div>
       </div>




   </section>
    </div>
</main>


<?php
require "footer.php";
?>
