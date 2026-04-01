<?php

include('../../config/database.php');

$id = $_GET['id'];

/*
update payment status
*/

$conn->query("

UPDATE requests

SET payment_status='Paid'

WHERE id='$id'

");

/*
optional record in payments table
*/

$conn->query("

INSERT INTO payments
(request_id,status)

VALUES
('$id','Paid')

");

header("Location: dashboard.php");

?>
