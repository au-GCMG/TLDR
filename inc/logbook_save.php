<?php
require_once "dbconn.inc.php";

$studentL = str_replace(","," ", strtoupper($_POST['studentl']));
$studentName = str_replace(","," ",strtoupper($_POST['studentname']));
$date = $_POST['date'];
$startTime = date('H:i:s',strtotime($_POST['starttime']));
$finishTime = date('H:i:s',strtotime($_POST['finishtime']));
$duration = (strtotime($finishTime) - strtotime($startTime))/60;
$fromLocation = str_replace(","," ", strtoupper($_POST['locationstart']));
$toLocation = str_replace(","," ", strtoupper($_POST['locationfinish']));
$road = strtoupper($_POST['road']);
$weather = strtoupper($_POST['weather']);
$traffic  = strtoupper($_POST['traffic']);
$qsdName = str_replace(","," ", strtoupper($_POST['qsdname']));
$qsdLicence = str_replace(","," ", strtoupper($_POST['qsdlicence']));
$studentSignature = 0;
$qsdSignature = 1;
$sql = "INSERT INTO RecordGreen(studentL,studentName,date,startTime,finishTime,duration,fromLocation,toLocation,road,weather,traffic,qsdName,qsdLicence,studentSignature,qsdSignature) VALUES";
$sql = $sql."('".$studentL."','".$studentName."','".$date."','".$startTime."','".$finishTime."','".$duration."','".$fromLocation."','".$toLocation."','".$road."','".$weather."','".$traffic."','".$qsdName."','".$qsdLicence."','".$studentSignature."','".$qsdSignature."')";
$result = mysqli_query($conn, $sql);
//echo $sql;
if($result)
{
    //echo '<script>window.close();</script>';
    $url = "../logbook.php?studentL=".base64_encode($studentL);
    header("location: $url");
}

?>