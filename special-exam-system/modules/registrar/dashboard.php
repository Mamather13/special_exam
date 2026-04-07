<?php

include('../../config/database.php');
include('../../templates/header.php');

/* get all requests */

$result = $conn->query("

SELECT 
requests.*,

students.student_number,
students.program,
students.year_level,

users.Lname,
users.Fname,
users.Mname

FROM requests

LEFT JOIN students
ON requests.student_id = students.id

LEFT JOIN users
ON students.user_id = users.id

ORDER BY requests.date_submitted DESC

");

?>

<h2>Registrar Dashboard</h2>

<p>All Special Examination Requests</p>

<table border="1" cellpadding="10">

<tr>

<th>Student Name</th>
<th>Student Number</th>
<th>Program</th>
<th>Year</th>
<th>Subject</th>
<th>Exam Type</th>
<th>Reason</th>
<th>Status</th>
<th>Payment</th>
<th>Documents</th>

</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>

<?php

echo 
$row['Lname'] . ", " .
$row['Fname'] . " " .
$row['Mname'];

?>

</td>

<td>

<?php echo $row['student_number']; ?>

</td>

<td>

<?php echo $row['program']; ?>

</td>

<td>

<?php echo $row['year_level']; ?>

</td>

<td>

<?php echo $row['subject']; ?>

</td>

<td>

<?php echo $row['exam_type']; ?>

</td>

<td>

<?php echo $row['reason']; ?>

</td>

<td>

<?php echo $row['status']; ?>

</td>

<td>

<?php echo $row['payment_status']; ?>

</td>

<td>

<a href="../../uploads/parent_id/<?php echo $row['parent_id_front']; ?>" target="_blank">
ID Front
</a>

<br>

<a href="../../uploads/parent_id/<?php echo $row['parent_id_back']; ?>" target="_blank">
ID Back
</a>

<br>

<a href="../../uploads/parent_id/<?php echo $row['parent_selfie']; ?>" target="_blank">
Selfie
</a>

<br>

<a href="../../uploads/signatures/<?php echo $row['parent_signature']; ?>" target="_blank">
Signature
</a>

<br>

<?php if($row['medical_certificate']){ ?>

<a href="../../uploads/documents/<?php echo $row['medical_certificate']; ?>" target="_blank">
Medical Cert
</a>

<br>

<?php } ?>

<?php if($row['death_certificate']){ ?>

<a href="../../uploads/documents/<?php echo $row['death_certificate']; ?>" target="_blank">
Death Cert
</a>

<br>

<?php } ?>

<?php if($row['supporting_document']){ ?>

<a href="../../uploads/documents/<?php echo $row['supporting_document']; ?>" target="_blank">
Other File
</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

<?php include('../../templates/footer.php'); ?>
