<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "e_commerce";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword,$dBName);

if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
}



