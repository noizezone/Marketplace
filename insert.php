<?php
require "header.php";

/* product_id    id_user    title    description    publication_date*/
?>

<main>
    <div class="container col-lg-12">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <h1 id="signup-title">Add Item</h1>
                    </div>
                    <div class="col-sm"></div>
                </div>
            </div>
            <form class="col-sm-6" action="includes/insert.inc.php" method="POST">
                <input class="form-control" type="text" name="title" placeholder="Title"><br>
                <input class="form-control" type="text" name="description" placeholder="Description"><br>
                <button class="form-control btn btn-dark" type="submit" name="item-submit">Add Item</button>
            </form>
        </section>
    </div>
</main>
