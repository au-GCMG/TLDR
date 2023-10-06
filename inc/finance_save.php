<?php
require_once "dbconn.inc.php";

$studentL = str_replace(","," ", strtoupper($_POST['studentl']));
$studentName = str_replace(","," ",strtoupper($_POST['studentname']));
$payeeL = str_replace(","," ", strtoupper($_POST['payeel']));
$payeeName = str_replace(","," ", strtoupper($_POST['payeename']));
$date = $_POST['date'];
$invoiceN = "INV".time().$studentL;
$description = str_replace(","," ", strtoupper($_POST['description']));
$unitprice = $_POST['unitprice'];
$unit = $_POST['unit'];
$amount = $_POST['amount'];
$tax = $_POST['tax'];
$paid = 0;
$sql = "INSERT INTO payment(studentL,studentName,payeeL, payeeName,date,invoiceN,description,unitprice,unit,amount,tax,paid) VALUES";
$sql = $sql."('".$studentL."','".$studentName."','".$payeeL."','".$payeeName."','".$date."','".$invoiceN."','".$description."','".$unitprice."','".$unit."','".$amount."','".$tax."','".$paid."')";
$result = mysqli_query($conn, $sql);
if($result)
{
    //echo '<script>window.close();</script>';
    $url = "../finance.php?studentL=".base64_encode($studentL);
     header("location: $url");
}


?>