<?php

include('../../config/database.php');
include('../../templates/header.php');

/*
show only students who need payment
*/

$result = $conn->query("

SELECT * FROM requests

WHERE payment_status='Pending Payment'

");

?>

<h2>Cashier Dashboard</h2>

<h3>Students Required to Pay ₱200</h3>

<table border="1" cellpadding="10">

<tr>

<th>Request ID</th>
<th>Subject</th>
<th>Exam Type</th>
<th>Reason</th>
<th>Payment Status</th>
<th>Action</th>

</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td><?php echo $row['exam_type']; ?></td>

<td><?php echo $row['reason']; ?></td>

<td><?php echo $row['payment_status']; ?></td>

<td>

<a href="confirm_payment.php?id=<?php echo $row['id']; ?>">

Confirm Payment

</a>

</td>

</tr>

<?php } ?>

</table>

<?php include('../../templates/footer.php'); ?>
