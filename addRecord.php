<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD ADD RECORD" />
    <link rel = "stylesheet", type="text/css", href="styles/addrecord.css"> 
    <script src="scripts/addRecord.js"></script>     
    <title>Add Record</title>
  </head>
  <body>
  <div>    
  <form>
        <label>Date:</label><input id = "currentdate" type = 'date' name = 'date'><br>        
        <p>Time</p>
        <label>Start:</label><input id = "starttime" type = 'time' name = 'starttime'><input type = 'button' value="Start">
        <label>Finish:</label><input id = "finishtime" type = 'time' name = 'finishtime'><input type = 'button' value="End"><br>
        <p>Location</p>
        <label>Start:</label><input  type = 'text' name = "locationstart">
        <label>Finish:</label><input type = 'text' name = "locationfinish">
        <p>Condition</p>
        <label>Road:</label>
            <select name = "road" id = "road">
                <option value="sealed">Sealed</option>
                <option value="unsealed">Unsealed</option>
                <option value ="quiet street">Quiet Street</option>
                <option value="busy road">Busy Road</option>
                <option value="multi-laned road">Multi-laned Road</option>
            </select>
        <label>Weather:</label>
            <select name="weather" id="weather">
                <option value="dry">Dry</option>
                <option value="wet">Wet</option>
            </select>
        <label>Traffic:</label>
            <select name="traffic" id = "traffic">
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

