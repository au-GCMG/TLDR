<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD ADD RECORD" />
    <link rel = "stylesheet", type="text/css", href="styles/addrecord.css"> 
    <script src="scripts/addRecord.js"></script>
    <script src="scripts/gps.js"></script>
    <title>Add Record</title>
  </head>
  <body>
    <script>
        function closePage()
        {
            if(confirm("This page will be closed.\nAll information will be lost!"))
            {
                window.opener = null;
                window.open('','_self');
                window.close();
            }
        }
    </script>
    <?php
        $studentL = $_POST['studentL'];
        $qsdL = $_POST['qsdL'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where licence = '$studentL'";
        $result = mysqli_query($conn, $sql);        
        $firstname = "";
        $surname = "";
        $fullname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $surname = $row['surname'];
            $firstname = $row['firstname'];
            $fullname = $firstname." ". $surname;
          }
        }
        mysqli_free_result($result);
    ?>
    <div id = "titleArea">
        <h2>To Student: <?=$fullname?></h2>
    </div>
    <div id = "dataArea">   
        <div id = "formData"> 
            <form  id = "formID" action="inc/add.php" method="post">            
                <label>Date:</label><input class = "user" id = "currentdate" type = 'date' name = 'date' required><br><br>       
                <a>Time</a><br>
                <label>Start:</label><input class = "user" id = "starttime" type = 'time' required name = 'starttime' value = "00:00">&nbsp&nbsp<input class = "user" type = 'button' value="Start" onclick="getStartTime();">&nbsp&nbsp&nbsp&nbsp
                <label>Finish:</label><input class = "user" id = "finishtime" type = 'time' required name = 'finishtime' value = "00:00">&nbsp&nbsp<input class = "user" type = 'button' value="End" onclick="getEndTime();"><br><br>
                <a>Location</a>&nbsp&nbsp<input class = "user" type = "button" value = "Activate GPS" onclick = "gps();"><br><br>
                <label>Start:</label><input  class = "user" type = 'text' name = "locationstart" required>
                <label>Finish:</label><input class = "user" type = 'text' name = "locationfinish" required><br><br>
                <a>Condition</a><br>
                <label>Road:</label>
                <select class = "user" name = "road" id = "road" required>
                        <option value="sealed">Sealed</option>
                        <option value="unsealed">Unsealed</option>
                        <option value ="quiet street">Quiet Street</option>
                        <option value="busy road">Busy Road</option>
                        <option value="multi-laned road">Multi-laned Road</option>
                </select>
                <label>Weather:</label>
                <select class = "user" name="weather" id="weather" required>
                    <option value="dry">Dry</option>
                    <option value="wet">Wet</option>
                </select>
                <label>Traffic:</label>
                <select class = "user" name="traffic" id = "traffic" required>
                    <option value="light">Light</option>
                    <option value="medium">Medium</option>
                    <option value="heavy">Heavy</option>
                </select>
                <p></p>
                <script>init();</script>
                <input class = "user" type="submit" name = "submit" id = "submit" style ="width:100px; height:35px; text-align: center">
                <input class = "user" type="submit" name = "closesubmit" id = "closesubmit" value = "Close" style ="width:100px; height:35px; text-align: center" onclick="closePage()">
            </form>
        </div>
    
    </div>
    
  </body>
</html>

