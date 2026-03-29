<?php include('../../templates/header.php'); ?>

<h2>Special Examination Request Form</h2>

<form action="submit_request.php" method="POST" enctype="multipart/form-data">

<label>Student Number:</label><br>
<input type="text" name="student_number" required><br><br>

<label>Last Name:</label><br>
<input type="text" name="Fname" required><br><br>
<label>First Name:</label><br>
<input type="text" name="Lname" required><br><br>
<label>Middle Name:</label><br>
<input type="text" name="Mname" required><br><br>

<label>Program:</label><br>
<input type="text" name="program" required><br><br>

<label>Year Level:</label><br>
<select name="year_level">
<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
<option>4th Year</option>
</select><br><br>

<label>Contact Number:</label><br>
<input type="text" name="contact_number" required><br><br>

<label>Term:</label><br>
<input type="text" name="term" placeholder="1st Term"><br><br>

<label>School Year:</label><br>
<input type="text" name="school_year" placeholder="2025-2026"><br><br>

<label>Exam Type:</label><br>
<select name="exam_type">
<option>Pre lim</option>
<option>Midterm</option>
<option>Pre final</option>
<option>Final</option>
</select><br><br>

<label>Subject:</label><br>
<input type="text" name="subject" required><br><br>

<label>Section:</label><br>
<input type="text" name="section"><br><br>

<label>Teacher Name:</label><br>
<input type="text" name="teacher_name"><br><br>

<label>Reason for Special Exam:</label><br>
<textarea name="reason"></textarea><br><br>

<h3>Parent Verification</h3>

<label>Parent ID (Front):</label><br>
<input type="file" name="parent_id_front"><br><br>

<label>Parent ID (Back):</label><br>
<input type="file" name="parent_id_back"><br><br>

<label>Parent Selfie holding ID:</label><br>
<input type="file" name="parent_selfie"><br><br>

<h3>Digital Signature</h3>

<canvas id="signature-pad" width="300" height="150" style="border:1px solid black;"></canvas>

<input type="hidden" name="signature" id="signature">

<br>

<button type="button" onclick="saveSignature()">Save Signature</button>

<h3>Supporting Documents</h3>

<label>Medical Certificate:</label><br>
<input type="file" name="medical_certificate"><br><br>

<label>Death Certificate:</label><br>
<input type="file" name="death_certificate"><br><br>

<label>Other Supporting Document:</label><br>
<input type="file" name="supporting_document"><br><br>


<button type="submit">Submit Request</button>

</form>

<script>

var canvas = document.getElementById("signature-pad");
var ctx = canvas.getContext("2d");

var drawing = false;

canvas.onmousedown = function(){
drawing = true;
}

canvas.onmouseup = function(){
drawing = false;
}

canvas.onmousemove = function(e){

if(!drawing) return;

ctx.lineWidth = 2;
ctx.lineCap = "round";

ctx.lineTo(e.offsetX,e.offsetY);
ctx.stroke();

}

function saveSignature(){

var dataURL = canvas.toDataURL();

document.getElementById("signature").value = dataURL;

alert("Signature saved");

}

</script>


<?php include('../../templates/footer.php'); ?>
