<?php
require_once "inc/dbconn.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 从POST请求中获取所需的数据
    $licence = $_POST['licence'];
    $AssessmentID = $_POST['AssessmentID'];
    $date = date('Y-m-d');
    $studentSignature = $_POST['firstname'] . " " . $_POST['surname']; 

    // 构建SQL查询
    $sql = "UPDATE Tasksignoff 
            SET DATE = '$date', StudentSignature = '$studentSignature'
            WHERE licence = '$licence' AND AssessmentID = '$AssessmentID'";

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