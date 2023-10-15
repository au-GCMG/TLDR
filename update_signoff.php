<?php
require_once "inc/dbconn.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $licence = $_POST['licence'];
    $AssessmentID = $_POST['AssessmentID'];
    $taskid = $_POST['taskid'];
    // $DATE = date("Y-m-d");  
    $InstructorSignature = $_POST['instructorSignature'];
    $mdi = $_POST['mdi'];


$sql = "INSERT INTO Tasksignoff (licence, AssessmentID, taskid, InstructorSignature, mdi)
VALUES ('$licence', '$AssessmentID', '$taskid', '$InstructorSignature', '$mdi') 
ON DUPLICATE KEY UPDATE 
AssessmentID = '$AssessmentID',  
mdi = '$mdi'";


    // 执行查询
    if (mysqli_query($conn, $sql)) {
        echo "Records successfully updated.";
    } else {
        echo "Error updating the records.";
    }
} else {
    echo "Invalid request method.";
}

?>