<?php
    //Author: Shansong Huang
    //TLDR student overview details Page
    
    //overview's details
    $totalCompleted = 0;
    $daytimeCompleted = 0;
    $nighttimeCompleted = 0;
    $totalNosign = 0;
    $daytimeNosign = 0;
    $nighttimeNosign = 0;

    //extract the data from logbook database(recordgreen)
    //daytime and signed by student
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

    //night time and signed by student in logbook
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

    //daytime and no sign by stduent
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

    //nighttime and no signed by student
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

    //keep to display 0.00
    if(empty($totalPaid))
    {
      $totalPaid =0.00;
    }
    if(empty($totalUnpaid))
    {
      $totalUnpaid = 0.00;
    }
    $totalAmount = $totalUnpaid + $totalPaid;

    mysqli_close($conn);

?>