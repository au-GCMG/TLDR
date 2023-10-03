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
  <div>    
  <form>
        <label>Date:</label><input id = "currentdate" type = 'date' name = 'date' required><br><br>       
        <a>Time</a><br>
        <label>Start:</label><input id = "starttime" type = 'time' required name = 'starttime' value = "00:00">&nbsp&nbsp<input type = 'button' value="Start" onclick="getStartTime();">
        <label>Finish:</label><input id = "finishtime" type = 'time' required name = 'finishtime' value = "00:00">&nbsp&nbsp<input type = 'button' value="End" onclick="getEndTime();"><br><br>
        <a>Location</a>&nbsp&nbsp<input type = "button" value = "Activate GPS" onclick = "gps();"><br>
        <label>Start:</label><input  type = 'text' name = "locationstart" required>
        <label>Finish:</label><input type = 'text' name = "locationfinish" required><br><br>
        <a>Condition</a><br>
        <label>Road:</label>
            <select name = "road" id = "road" required>
                <option value="sealed">Sealed</option>
                <option value="unsealed">Unsealed</option>
                <option value ="quiet street">Quiet Street</option>
                <option value="busy road">Busy Road</option>
                <option value="multi-laned road">Multi-laned Road</option>
            </select>
        <label>Weather:</label>
            <select name="weather" id="weather" required>
                <option value="dry">Dry</option>
                <option value="wet">Wet</option>
            </select>
        <label>Traffic:</label>
            <select name="traffic" id = "traffic" required>
                <option value="light">Light</option>
                <option value="medium">Medium</option>
                <option value="heavy">Heavy</option>
            </select>
        <p></p>
        <script>init();</script>
        <input type="submit" name = "submit" id = "submit">
    </form>
    
  </div>
    
  </body>
</html>

