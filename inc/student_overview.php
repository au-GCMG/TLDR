<?php
    $totalCompleted = 0;
    $daytimeCompleted = 0;
    $nighttimeCompleted = 0;
    $totalNosign = 0;
    $daytimeNosign = 0;
    $nighttimeNosign = 0;

    //require_once "inc/dbconn.inc.php";
    $sql = "SELECT SUM(duration) AS durations FROM recordgreen where studentL = '{$licence}' and studentSignature = 1 and qsdSignature = 1 and startTime < '18:00:00'";
    $result1 = mysqli_query($conn, $sql);
    if($result1)
    {
      if(mysqli_num_rows($result1) > 0)
      {
        $row = mysqli_fetch_assoc($result1);
        $daytimeCompleted = $row['durations'];
      }
    }
    mysqli_free_result($result1);

    $sql = "SELECT SUM(duration) AS durations FROM recordgreen where studentL = '{$licence}' and studentSignature = 1 and qsdSignature = 1 and startTime >= '18:00:00'";
    $result2 = mysqli_query($conn, $sql);
    if($result1)
    {
      if(mysqli_num_rows($result2) > 0)
      {
        $row = mysqli_fetch_assoc($result2);
        $nighttimeCompleted = $row['durations'];
      }
    }
    mysqli_free_result($result2);

    $sql = "SELECT SUM(duration) AS durations FROM recordgreen where studentL = '{$licence}' and studentSignature = 0 and qsdSignature = 1 and startTime < '18:00:00'";
    $result3 = mysqli_query($conn, $sql);
    if($result3)
    {
      if(mysqli_num_rows($result3) > 0)
      {
        $row = mysqli_fetch_assoc($result3);
        $daytimeNosign = $row['durations'];
      }
    }
    mysqli_free_result($result3);

    $sql = "SELECT SUM(duration) AS durations FROM recordgreen where studentL = '{$licence}' and studentSignature = 0 and qsdSignature = 1 and startTime >= '18:00:00'";
    $result4 = mysqli_query($conn, $sql);
    if($result4)
    {
      if(mysqli_num_rows($result4) > 0)
      {
        $row = mysqli_fetch_assoc($result4);
        $nighttimeNosign = $row['durations'];
      }
    }
    mysqli_free_result($result4);


    mysqli_close($conn);

    $totalCompleted = $daytimeCompleted + $nighttimeCompleted;
    $totalNosign = $daytimeNosign + $nighttimeNosign;
    $daytimeRemaining = 3600 - $daytimeCompleted;
    $nighttimeRemaining = 900 - $nighttimeCompleted;
?>