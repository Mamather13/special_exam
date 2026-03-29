<?php

include('../../config/database.php');

$student_number = $_POST['student_number'];
$Lname = $_POST['Lname'];
$Fname = $_POST['Fname'];
$Mname = $_POST['Mname'];
$program = $_POST['program'];
$year_level = $_POST['year_level'];
$contact_number = $_POST['contact_number'];

$term = $_POST['term'];
$school_year = $_POST['school_year'];
$exam_type = $_POST['exam_type'];
$subject = $_POST['subject'];
$section = $_POST['section'];
$teacher_name = $_POST['teacher_name'];
$reason = $_POST['reason'];

$parent_id_front = $_idfront['parent_id_front']['name'];
$parent_id_back = $_idback['parent_id_back']['name'];
$parent_id_selfie = $_idselfie['parent_id_selfie']['name'];
$parent_signature = $_signature['parent_signature']['name'];



move_uploaded_file(
$_idfront['parent_id_front']['tmp_name'],
"../../uploads/parent_id/".$parent_id_front
$_idback['parent_id_back']['tmp_name'],
"../../uploads/parent_id/".$parent_id_back
$_idselfie['parent_id_back']['tmp_name'],
"../../uploads/parent_id/".$parent_id_selfie

$_signature['parent_signature']['tmp_name'],
"../../uploads/signatures/".$parent_signature





);


/* save user */

$conn->query("INSERT INTO users (name,email,role)
VALUES ('$Lname','$Fname','$Mname','$student_number','student')");

$user_id = $conn->insert_id;

/* save student */

$conn->query("INSERT INTO students
(user_id,student_number,program,year_level,contact_number)

VALUES
('$user_id','$student_number','$program','$year_level','$contact_number')");

$student_id = $conn->insert_id;

/* save request */

$conn->query("INSERT INTO requests
(student_id,term,school_year,exam_type,subject,section,teacher_name,reason)

VALUES
('$student_id','$term','$school_year','$exam_type','$subject','$section','$teacher_name','$reason')");

echo "Request Submitted Successfully";

?>
