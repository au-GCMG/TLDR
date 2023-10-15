<?php

require_once "inc/dbconn.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 从POST请求中获取所需的数据
    $assessmentItemID = $_POST['AssessmentItemID'];
    $AssessmentID = $_POST['AssessmentID'];
    $signCount = $_POST['SignCount'];
    $mdi = $_POST['mdi'];
    $licence = $_POST['licence']; 
    $signCompletion = 1;  

    // 构建SQL查询
    $sql = "INSERT INTO ItemCompletion (AssessmentItemID, AssessmentID, SignCount, SignCompletion, mdi, licence) 
            VALUES ('$assessmentItemID', '$AssessmentID', '$signCount', '$signCompletion', '$mdi', '$licence') 
            ON DUPLICATE KEY UPDATE 
            SignCount = '$signCount', 
            SignCompletion = '$signCompletion', 
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