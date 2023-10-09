<?php
//obtain parameters as fields to table homeworkcompletion
$itemid = $_GET['itemid'];
$studentL = base64_decode($_GET['l']);
$numberofsigned = $_GET['sign'];

require_once "inc/dbconn.inc.php";
//update or insert
$sql = "SELECT * FROM homeworkcompletion WHERE licence='".$studentL."' and itemid='".$itemid."'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        $sql = "UPDATE";
    }
    else
    {
        $sql = "INSERT INTO";
    }
}
mysqli_free_result($result);
//Run update or insert statemnet

//deal with the address of last page to return
$url = "MyCBT.php?";
$para = $_SERVER['QUERY_STRING'];//the string of all parameter
$para = substr($para, 0, strripos($para, '&'));//get off the last parameter
$para = substr($para, 0, strripos($para, '&'));//get off the second to last
$para = substr($para, 0, strripos($para, '&'));//get off the third to last
$url = $url.$para;
echo $url;
?>