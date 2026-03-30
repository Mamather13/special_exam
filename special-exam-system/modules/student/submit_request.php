<?php

include('../../config/database.php');

/* student info */

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

/* upload files */

/* parent id front */

$parent_id_front = $_FILES['parent_id_front']['name'];

move_uploaded_file(

$_FILES['parent_id_front']['tmp_name'],

"../../uploads/parent_id/".$parent_id_front

);

/* parent id back */

$parent_id_back = $_FILES['parent_id_back']['name'];

move_uploaded_file(

$_FILES['parent_id_back']['tmp_name'],

"../../uploads/parent_id/".$parent_id_back

);

/* parent selfie */

$parent_selfie = $_FILES['parent_selfie']['name'];

move_uploaded_file(

$_FILES['parent_selfie']['tmp_name'],

"../../uploads/parent_id/".$parent_selfie

);

/* medical certificate */

$medical_certificate = $_FILES['medical_certificate']['name'];

move_uploaded_file(

$_FILES['medical_certificate']['tmp_name'],

"../../uploads/documents/".$medical_certificate

);

/* death certificate */

$death_certificate = $_FILES['death_certificate']['name'];

move_uploaded_file(

$_FILES['death_certificate']['tmp_name'],

"../../uploads/documents/".$death_certificate

);

/* other document */

$supporting_document = $_FILES['supporting_document']['name'];

move_uploaded_file(

$_FILES['supporting_document']['tmp_name'],

"../../uploads/documents/".$supporting_document

);

/* digital signature */

$signature = $_POST['signature'];

$signature_file = time().".png";

$signature = str_replace("data:image/png;base64,","",$signature);

$signature = base64_decode($signature);

file_put_contents(

"../../uploads/signatures/".$signature_file,

$signature

);

$reason_type = $_POST['reason_type'];

if(!empty($medical_certificate)){

$payment_status = "Exempted";

}
elseif(!empty($death_certificate)){

$payment_status = "Exempted";

}
else{

$payment_status = "Pending Payment";

}


/* save user */

$conn->query("INSERT INTO users (Lname,Fname,Mname,email,role)

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

(student_id,term,school_year,exam_type,subject,section,teacher_name,reason,

parent_id_front,parent_id_back,parent_selfie,parent_signature,

medical_certificate,death_certificate,supporting_document,payment_status)

VALUES

('$student_id','$term','$school_year','$exam_type','$subject','$section','$teacher_name','$reason',

'$parent_id_front','$parent_id_back','$parent_selfie','$signature_file',

'$medical_certificate','$death_certificate','$supporting_document','$payment_status')");


echo "Request submitted successfully";

?>
