<?php
//echo $_GET["id"], "<br>";


if(isset($_GET["id"]))
{
    
    require_once "dbconn.inc.php";
    $sql =  "UPDATE recordgreen SET studentSignature = 1 where id = ?";
    $statemnet = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statemnet, $sql);
    mysqli_stmt_bind_param($statemnet, 's', htmlspecialchars($_GET["id"]));
    if(mysqli_stmt_execute($statemnet))
    {
        header("location: ../MyLogbookD.php");
    }
    else
    {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
}



?>