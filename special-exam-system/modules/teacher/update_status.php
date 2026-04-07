<?php

include('../../config/db.php');

session_start();

$request_id = $_POST['request_id'];

$role = $_SESSION['role'];


/* APPROVE */

if(isset($_POST['approve'])){

if($role=="program_head"){

$status = "Approved by Program Head";

}

else{

$status = "Approved by Teacher";

}

mysqli_query($conn,"

UPDATE submit_form

SET status='$status'

WHERE request_id='$request_id'

");

}


/* REJECT */

if(isset($_POST['reject'])){

$reason = $_POST['reason'];


if($role=="program_head"){

$status = "Rejected by Program Head";

}

else{

$status = "Rejected by Teacher";

}

mysqli_query($conn,"

UPDATE submit_form

SET 
status='$status',
reject_reason='$reason'

WHERE request_id='$request_id'

");

}

header("Location: dashboard.php");

?>
