<?php
//echo $_GET["id"], "<br>";


if(isset($_GET["id"]))
{
    echo "<p style = 'font-size: 30px; text-align: center;'>Processing.....</p>";
    echo "<p style = 'font-size: 25px; text-align: center; color:red'>Please don't close/refresh this page!</p>";
    

       
    require_once "dbconn.inc.php";
    $sql =  "UPDATE payment SET paid = 1 where id = ?";
    $statemnet = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statemnet, $sql);
    $id = htmlspecialchars($_GET["id"]); 
    mysqli_stmt_bind_param($statemnet, 's', $id);
    if(mysqli_stmt_execute($statemnet))
    {
        echo "<p style = 'font-size: 30px; text-align: center;'>All done!</p>";
        echo "<p style = 'font-size: 25px; text-align: center;'>The page will be return in 5 seconds</p>";
        header("Refresh:5 ../MyFinance.php");
    }
    else
    {
        echo mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>