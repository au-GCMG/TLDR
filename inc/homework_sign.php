<?php
//obtain parameters as fields to table homeworkcompletion
$itemid = $_GET['itemid'];
$studentL = base64_decode($_GET['l']);
$numberofsigned = $_GET['sign'];

require_once "dbconn.inc.php";
//update or insert
$sql = "SELECT * FROM homeworkcompletion WHERE licence='".$studentL."' and itemid='".$itemid."'";
$result = mysqli_query($conn, $sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        switch($numberofsigned)
        {
            case 2:
                $sql = "UPDATE homeworkcompletion SET studentsign1=1";;
                break;
            case 1:
                $sql = "UPDATE homeworkcompletion SET studentsign2=1";
                break;
        }        
    }
    else
    {
        $sql = "INSERT INTO homeworkcompletion(licence, itemid, studentsign1, studentsign2) VALUES('".$studentL."','".$itemid."',1,0)";
    }
}

//Run update or insert statemnet
//echo $sql;
$result = mysqli_query($conn, $sql);
//deal with the address of last page to return
$url = "../MyCBT.php?";
$para = $_SERVER['QUERY_STRING'];//the string of all parameter
$para = substr($para, 0, strripos($para, '&'));//get off the last parameter
$para = substr($para, 0, strripos($para, '&'));//get off the second to last
$para = substr($para, 0, strripos($para, '&'));//get off the third to last
$url = $url.$para;
echo $url;
header("location:".$url);
mysqli_free_result($result);
mysqli_close($conn);
?>