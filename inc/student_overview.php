<?php
    $totalCompleted = 0;
    $daytimeCompleted = 0;
    $nighttimeCompleted = 0;
    $totalNosign = 0;
    $daytimeNosign = 0;
    $nighttimeNosign = 0;

    //extract the data from logbook database(recordgreen)
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
    if(empty($daytimeCompleted))
    {
      $daytimeCompleted = 0;
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
    if(empty($nighttimeCompleted))
    {
      $nighttimeCompleted = 0;
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
    if(empty($daytimeNosign))
    {
      $daytimeNosign = 0;
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
    if(empty($nighttimeNosign))
    {
      $nighttimeNosign = 0;
    }
    mysqli_free_result($result4);

    //summary for payment
    $totalPaid = 0.00;
    $totalUnpaid = 0.00;
    $totalAmount = 0.00;
    //Paid
    $sql = "SELECT SUM(amount) AS amount FROM payment where studentL = '{$licence}' and paid = 1";
    $result5 = mysqli_query($conn, $sql);
    if($result5)
    {
      if(mysqli_num_rows($result5) > 0)
      {
        $row = mysqli_fetch_assoc($result5);
        $totalPaid = $row['amount'];
      }
    }    
    mysqli_free_result($result5);
    
    //unpaid
    $sql = "SELECT SUM(amount) AS amount FROM payment where studentL = '{$licence}' and paid = 0";
    $result6 = mysqli_query($conn, $sql);
    if($result5)
    {
      if(mysqli_num_rows($result6) > 0)
      {
        $row = mysqli_fetch_assoc($result6);
        $totalUnpaid = $row['amount'];
      }      
    }
    mysqli_free_result($result6);   

    $totalCompleted = $daytimeCompleted + $nighttimeCompleted;
    $totalNosign = $daytimeNosign + $nighttimeNosign;
    $daytimeRemaining = 3600 - $daytimeCompleted;
    $nighttimeRemaining = 900 - $nighttimeCompleted;

    if(empty($totalPaid))
    {
      $totalPaid =0.00;
    }
    if(empty($totalUnpaid))
    {
      $totalUnpaid = 0.00;
    }
    $totalAmount = $totalUnpaid + $totalPaid;

    
    //extract baseic data form CBT database(sys_unit, sys_task, sys_item)
    $totalUnit = 0;
    $totalTask = 0;
    $totalItem = 0;
    //sys_unit
    $sql = "select count(*) AS totalNO from sys_unit";
    $result7 = mysqli_query($conn, $sql);
    if($result7)
    {
      if(mysqli_num_rows($result7) > 0)
      {
        $row = mysqli_fetch_assoc($result7);
        $totalUnit = $row['totalNO'];
      }      
    }
    mysqli_free_result($result7);
    //sys_task    
    $sql = "select count(*) AS totalNO from sys_task";
    $result8 = mysqli_query($conn, $sql);
    if($result8)
    {
      if(mysqli_num_rows($result8) > 0)
      {
        $row = mysqli_fetch_assoc($result8);
        $totalTask = $row['totalNO'];
      }      
    }
    mysqli_free_result($result8);
    //sys_item       
    $sql = "select count(*) AS totalNO from sys_item";
    $result9 = mysqli_query($conn, $sql);
    if($result9)
    {
      if(mysqli_num_rows($result9) > 0)
      {
        $row = mysqli_fetch_assoc($result9);
        $totalItem = $row['totalNO'];
      }      
    }
    mysqli_free_result($result9);
    mysqli_close($conn);

?>