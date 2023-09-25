<?php
 if($currentTime == "DAY")
 {
    $sql = "SELECT * FROM recordgreen where studentL = '{$licence}' and qsdSignature = 1 and startTime < '18:00:00' order by date";
 }
 else
 {
    $sql = "SELECT * FROM recordgreen where studentL = '{$licence}' and qsdSignature = 1 and startTime >= '18:00:00' order by date";
 }
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
                    echo "<th style = 'width: 7%'>";
                    if($currentTime == "DAY")
                    {
                        echo "<a href = inc/day_sign.php?id=",$row['id'],">Sign</a>";
                    }
                    else
                    {
                        echo "<a href = inc/night_sign.php?id=",$row['id'],">Sign</a>";
                    }
                    echo "</th>";
                }
                else
                {
                    echo "<th style = 'width: 7%'>Y</th>";
                }
                
                echo "<th style = 'width: 15%'>",$row['qsdName'],"</th>";
                echo "<th style = 'width: 10%'>",$row['qsdLicence'],"</th>";
                echo "<th style = 'width: 7%'>Y</th>";
                echo "<th style = 'width: 10%'>";
                    echo "<form name = 'map' action='map.php' method='get' target='_blank'>";
                        echo "<input type = 'hidden' name = 'id' value = ",$row['id'],">";
                        echo "<input type = 'submit' value='map'>";
                    echo "</form>";
                echo "</th>";
                echo "</tr>";
            }
    }
 }
 mysqli_free_result($result1);
 mysqli_close($conn);

?>