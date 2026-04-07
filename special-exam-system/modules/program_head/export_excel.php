<?php

include('../../config/database.php');

/* force download as excel */

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=special_exam_report.xls");

/* query */

$result = $conn->query("

SELECT

DATE(requests.date_submitted) AS application_date,

students.section,
students.program,

users.Lname,
users.Fname,
users.Mname,

requests.subject,
requests.subject_code

FROM requests

LEFT JOIN students
ON requests.student_id = students.id

LEFT JOIN users
ON students.user_id = users.id

ORDER BY requests.date_submitted DESC

");

?>

<table border="1">

<tr>

<th>Date of Application</th>

<th>Student Name (Last Name, First Name, MI)</th>

<th>Section</th>

<th>Course/Subject Title</th>

<th>Course/Subject Code</th>

<th>Program/Strand</th>

</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>

<?php echo $row['application_date']; ?>

</td>

<td>

<?php

echo 
$row['Lname'] . ", " .
$row['Fname'] . " " .
substr($row['Mname'],0,1) . ".";

?>

</td>

<td>

<?php echo $row['section']; ?>

</td>

<td>

<?php echo $row['subject']; ?>

</td>

<td>

<?php echo $row['subject_code']; ?>

</td>

<td>

<?php echo $row['program']; ?>

</td>

</tr>

<?php } ?>

</table>
