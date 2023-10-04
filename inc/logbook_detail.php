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

    $totalCompleted = $daytimeCompleted + $nighttimeCompleted;
    echo "<div id = 'overview'>"; 
    echo "<hr>";
    echo "<p>LOGBOOK(Green)<p></p>Requirement of Total 4500 mins (Include 900 mins nighttime)</p>";
    echo "<div id = 'progress'>";
    echo "<label>Total&nbsp&nbsp    Completed: </label>";
    echo "<progress id = 'completed' max = '4500', value=$totalCompleted></progress>&nbsp&nbsp<a>$totalCompleted/4500min</a><p></p>"; 
    echo "<label>Day&nbsp&nbsp  Completed: </label>";
    echo "<progress id = 'daytimeCompleted' max = '3600', value=$daytimeCompleted></progress>&nbsp&nbsp<a>$daytimeCompleted/3600min</a><p></p>";
    echo "<label>Night  Completed: </label>";
    echo "<progress id = 'nighttimeCompleted' max = '900', value=$nighttimeCompleted></progress>&nbsp&nbsp<a>$nighttimeCompleted/900min</a><p></p>";
    echo "</div>";
    


    echo "<table id = 'greenRecord'>";
    echo "<thead>";
      echo "<tr>";
        echo "<th style = 'width: 7%' rowspan='2'>Date</th>";
        echo "<th style = 'width: 20%'colspan='3'>Time</th>";
        echo "<th style = 'width: 18%'colspan='2'>Location</th>";
        echo "<th style = 'width: 18%'colspan='3'>Condition</th>";
        echo "<th style = 'width: 7%'rowspan='2'>Learner's signature</th>";
        echo "<th style = 'width: 15%'colspan='2'>QSD</th>";
        echo "<th style = 'width: 7%'rowspan='2'>MAP</th>";
      echo "</tr>";
      echo "<tr>";
        echo "<th style = 'width: 5%'>Start</th>";
        echo "<th style = 'width: 5%'>Finish</th>";
        echo "<th style = 'width: 5%'>Duaration</th>";
        echo "<th style = 'width: 10%'>From</th>";
        echo "<th style = 'width: 10%'>TO</th>";
        echo "<th style = 'width: 5%'>Road</th>";
        echo "<th style = 'width: 5%'>Weather</th>";
        echo "<th style = 'width: 5%'>Traffic</th>";
        echo "<th style = 'width: 15%'>Full Name</th>";
        echo "<th style = 'width: 7%'>Signature</th>";
        echo"</tr>";
    echo "</thead>";
    echo "<tbody>";
        $sql = "SELECT * FROM recordgreen where studentL = '{$licence}' and qsdSignature = 1 order by date";
        $result1 = mysqli_query($conn, $sql);
        if($result1)
        {
            if(mysqli_num_rows($result1) > 0)
            {
                while($row = mysqli_fetch_assoc($result1))
                {                
                    echo "<tr>";
                    echo "<th style = 'width: 7%'>",$row['date'],"</th>";     
                    echo "<th style = 'width: 5%'>",$row['startTime'],"</th>";
                    echo "<th style = 'width: 5%'>",$row['finishTime'],"</th>";
                    echo "<th style = 'width: 5%'>",$row['duration'],"</th>";
                    echo "<th style = 'width: 10%'>",$row['fromLocation'],"</th>";
                    echo "<th style = 'width: 10%'>",$row['toLocation'],"</th>";
                    echo "<th style = 'width: 5%'>",$row['road'],"</th>";
                    echo "<th style = 'width: 5%'>",$row['weather'],"</th>";
                    echo "<th style = 'width: 5%'>",$row['traffic'],"</th>";
                    if($row['studentSignature'] == 0)
                    {
                        echo "<th style = 'width: 7%'>N</th>";                    
                    }
                    else
                    {
                        echo "<th style = 'width: 7%'>Y</th>";
                    }
                
                    echo "<th style = 'width: 15%'>",$row['qsdName'],"</th>";
                    echo "<th style = 'width: 7%'>Y</th>";
                    echo "<th style = 'width: 7%'>";
                        echo "<form name = 'map' action='map.php' method='get' target='_blank'>";
                        echo "<input type = 'hidden' name = 'id' value = ",$row['id'],">";
                        echo "<input type = 'submit' value='map'>";
                    echo "</form>";
                    echo "</th>";
                    echo "</tr>";
                }
            }
        }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
 mysqli_free_result($result1);

?>