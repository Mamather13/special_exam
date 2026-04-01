<?php

include('../../config/database.php');

$id = $_GET['id'];

$conn->query("UPDATE requests

SET status='Rejected'

WHERE id='$id'");

header("Location: dashboard.php");

?>
