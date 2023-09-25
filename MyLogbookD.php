<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR student" />
    <link rel = "stylesheet", type="text/css", href="styles/student.css">
    <link rel = "stylesheet", type="text/css", href="styles/logbookD.css">
    <script src="scripts/studentMenu.js" defer></script>
    <script src = "scripts/valid.js" defer></script>
    <title>Student</title>
  </head>
  <body>
    <?php
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $licence = "";
        $firstname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $licence = $row['licence'];
            $firstname = $row['firstname'];
            echo "<h2>Welcome $firstname ($licence)</h2>";                       
            require_once "inc/menu.inc.php";
          }
        }
        mysqli_free_result($result);
        //mysqli_close($conn);
        $totalCompleted = "2000";
        $daytimeCompleted = "1000";
        $nighttimeCompleted = "233";
    ?>
    <div id = 'mylogbook'>
        <div id = "switchArea">
          <a style = "color:lime">Day</a>
          <label class = "switch">
            <input type = "checkbox" onchange="changeDaytime()">
            <span class = "slider round"></span>
          </label><a style = "color: gray">night</a>
        </div>
        <h4>Record of Daytime Driving Hours</h4>
        <table id = 'greenRecord'>
          <thead>
            <tr>
              <th style = "width: 7%" rowspan="2">Date</th>
              <th style = "width: 18%"colspan="3">Time</th>
              <th style = "width: 18%"colspan="2">Location</th>
              <th style = "width: 18%"colspan="3">Condition</th>
              <th style = "width: 7%"rowspan="2">Learner's signature</th>
              <th style = "width: 25%"colspan="3">QSD</th>
              <th style = "width: 10%"rowspan="2">MAP</th>
            </tr>
            <tr>
              <th style = "width: 5%">Start</th>
              <th style = "width: 5%">Finish</th>
              <th style = "width: 5%">Duaration</th>
              <th style = "width: 10%">From</th>
              <th style = "width: 10%">TO</th>
              <th style = "width: 5%">Road</th>
              <th style = "width: 5%">Weather</th>
              <th style = "width: 5%">Traffic</th>
              <th style = "width: 15%">Full Name</th>
              <th style = "width: 10%">Licence No.</th>
              <th style = "width: 7%">Signature</th>
            </tr>
          </thead>
        <tbody>
            <?php
              $currentTime = "DAY";
              require_once "inc/student_logbook.php";              
            ?>
        </tbody>
        </table>
    </div>

  </body>
</html>