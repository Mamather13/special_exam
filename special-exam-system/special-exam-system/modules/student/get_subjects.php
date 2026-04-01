<?php

include('../../config/database.php');

$program = $_GET['program'];

$result = $conn->query("

SELECT subject_title, subject_code

FROM subjects

WHERE program='$program'

");

$data = [];

while($row = $result->fetch_assoc()){

$data[] = $row;

}

echo json_encode($data);
