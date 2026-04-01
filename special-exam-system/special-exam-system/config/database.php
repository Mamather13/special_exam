<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "special_exam_db";

$conn = new mysqli($host,$username,$password,$database);

if($conn->connect_error){

die("Connection failed");

}

?>
