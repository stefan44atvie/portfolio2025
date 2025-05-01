<?php

$localhost = "localhost";
$username = "d0439462";
$password = "pzhTEDaQ4kGGUJAcCvjj";
$dbname = "d0439462";

// create connection
$connect = new  mysqli($localhost, $username, $password, $dbname);

// check connection
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
// } else {
//     echo "Successfully Connected";
}