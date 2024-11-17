<?php

$servername = "localhost";
$username = "root";       
$password = "Hitler123@kalyana";           
$dbname = "interior_design"; 

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

