<?php
require_once "dbconn.inc.php";

$gpsnumber = $_POST['gpsnumber'];
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
if($duration > 0)
{
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        //echo '<script>window.close();</script>';
        //deal with the GPS data, it depend on the hardware of GPS
        //simulate 5 random sets data
    //Directly copy existing simulation data.
    //copy data of gps to folder and file
    if($gpsnumber != 0)
    {
        $flodername = $studentL;
        $path = "../MAPS/".$flodername;
        //create folder for studernt name: student' licence.
        if(!file_exists($path))
        {
            mkdir($path);
        }
        $filename = str_replace("-", "",$date).str_replace(":", "", $startTime).".txt";
        $source = "../MAPS/".$gpsnumber.".txt";
        $dest = $path."/".$filename;
    
        copy($source, $dest);
    
    }
    $url = "../logbook.php?studentL=".base64_encode($studentL);
    header("location: $url");
    }
}
else
{
    echo "The time of finishing is earlier than the time of startting.";
    
}
//echo $gpsnumber;


?>