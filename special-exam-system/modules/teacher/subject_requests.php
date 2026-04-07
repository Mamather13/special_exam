<?php

include('../../config/db.php');
include('../../templates/header.php');

$subject_id = $_GET['subject_id'];

$query = "

SELECT 

request_form.id,
request_form.reason,
request_form.date,

users.student_id,
users.name,

submit_form.status

FROM request_form

JOIN submit_form
ON submit_form.request_id = request_form.id

JOIN users
ON users.id = request_form.student_id

WHERE request_form.subject_id = '$subject_id'
AND submit_form.status = 'Submitted'

";

$result = mysqli_query($conn,$query);

?>


<link rel="stylesheet" href="../../assets/css/student-dashboard.css">
<link rel="stylesheet" href="../../assets/css/teacher-dashboard.css">

<div class="container">


<div class="header-with-back">

<a href="dashboard.php"

class="back-link">

← Back

</a>


<div>

<h1>Mathematics 101</h1>

<p class="sub-title">

Pending student applications

</p>

</div>


</div>



<div class="table-card">


<table class="app-table">

<thead>

<tr>

<th>Student</th>

<th>ID</th>

<th>Date</th>

<th>Reason</th>

<th>Action</th>

</tr>

</thead>



<tbody>

<?php while($row = mysqli_fetch_assoc($result)): ?>

<tr class="student-row">

<td>
<?=$row['name']?>
</td>

<td class="text-muted">
<?=$row['student_id']?>
</td>

<td class="text-muted">
<?=$row['date']?>
</td>

<td>
<?=$row['reason']?>
</td>

<td>

<div class="action-group">

<form method="POST"
action="update_status.php">

<input type="hidden"
name="request_id"
value="<?=$row['id']?>">

<button
name="approve"
class="btn-accept">

Accept

</button>

<button
type="button"
class="btn-reject"
data-id="<?=$row['id']?>">

Reject

</button>

</form>

</div>

</td>

</tr>

<?php endwhile; ?>

</tbody>



</table>


</div>


</div>



<!-- REJECT MODAL -->

<div class="modal hidden"

id="rejectModal">


<div class="modal-content">


<h3>Reason for rejection</h3>


<form method="POST"
action="update_status.php">


<input type="hidden"

name="request_id"

id="rejectRequestId">


<textarea

name="reason"

id="rejectReason"

placeholder="Enter reason">

</textarea>



<div class="action-group">


<button
type="button"

class="btn-cancel"

id="closeReject">

Cancel

</button>


<button

name="reject"

class="btn-confirm-reject">

Submit

</button>


</div>


</form>


</div>


</div>




<script src="../../assets/js/teacher-dashboard.js"></script>

<?php include('../../templates/footer.php'); ?>
