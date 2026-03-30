<?php

include('../config/database.php');
include('../templates/header.php');

/* total requests */

$total = $conn->query("SELECT COUNT(*) as count FROM requests")->fetch_assoc()['count'];

/* pending */

$pending = $conn->query("SELECT COUNT(*) as count FROM requests WHERE status='Pending'")->fetch_assoc()['count'];

/* approved */

$approved = $conn->query("SELECT COUNT(*) as count FROM requests WHERE status='Approved'")->fetch_assoc()['count'];

/* rejected */

$rejected = $conn->query("SELECT COUNT(*) as count FROM requests WHERE status='Rejected'")->fetch_assoc()['count'];

/* paid */

$paid = $conn->query("SELECT COUNT(*) as count FROM requests WHERE payment_status='Paid'")->fetch_assoc()['count'];

/* exempted */

$exempted = $conn->query("SELECT COUNT(*) as count FROM requests WHERE payment_status='Exempted'")->fetch_assoc()['count'];

?>

<h1>Central Monitoring Dashboard</h1>

<div style="display:flex;gap:20px;flex-wrap:wrap">

<div style="padding:20px;border:1px solid gray">
<h3>Total Requests</h3>
<h1><?php echo $total; ?></h1>
</div>

<div style="padding:20px;border:1px solid gray">
<h3>Pending</h3>
<h1><?php echo $pending; ?></h1>
</div>

<div style="padding:20px;border:1px solid gray">
<h3>Approved</h3>
<h1><?php echo $approved; ?></h1>
</div>

<div style="padding:20px;border:1px solid gray">
<h3>Rejected</h3>
<h1><?php echo $rejected; ?></h1>
</div>

<div style="padding:20px;border:1px solid gray">
<h3>Paid</h3>
<h1><?php echo $paid; ?></h1>
</div>

<div style="padding:20px;border:1px solid gray">
<h3>Exempted</h3>
<h1><?php echo $exempted; ?></h1>
</div>

</div>

<hr>

<h2>Recent Applications</h2>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>
<th>Subject</th>
<th>Exam Type</th>
<th>Status</th>
<th>Payment</th>

</tr>

<?php

$list = $conn->query("

SELECT * FROM requests

ORDER BY date_submitted DESC

LIMIT 10

");

while($row = $list->fetch_assoc()){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['subject']; ?></td>

<td><?php echo $row['exam_type']; ?></td>

<td><?php echo $row['status']; ?></td>

<td><?php echo $row['payment_status']; ?></td>

</tr>

<?php } ?>

</table>

<?php include('../templates/footer.php'); ?>
