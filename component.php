<?php

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

</body>
</html>

<?php
//<img src=\"uploads/$product_img\" alt=\"Image1\" class=\"img-fluid card-img-top\">


function component($productid, $title, $description, $publication_date, $product_img){
$element = "

<div id='product-container' class=\"col-md-3 col-sm-6 my-3 my-md-0\">
<form action=\"item.php\" method=\"post\">
    <div class=\"card shadow\">
    <div>
    <img id='index-images' src=\"uploads/$product_img\" alt=\"Image1\" class=\"img-fluid card-img-top\">
    </div>
    <div class=\"card-body\">
        <h5 class=\"card-title\">$title</h5>
        <p class=\"card-text\">
            <span class=\"price\">$description</span>
        </p>
        <h5>
           
            
        </h5>

        <p><b>Date:</b> $publication_date</p>

        <input type='hidden' name='product_id' value='$productid'>
        
        <a id='view-item' href='item.php'><button type=\"submit\" class=\"btn btn-dark my-3\" name=\"add\">View Item</button></a>
    </div>
    </div>
</form>
</div>
";


echo $element;
}

?>

