<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR student" />
    <link rel = "stylesheet", type="text/css", href="styles/student.css">
    <script src="scripts/studentMenu.js" defer></script>
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
        //$totalCompleted = 2500;
        //$daytimeCompleted = "1000";
        //$nighttimeCompleted = "233";
        require_once "inc/student-overview.php";
    ?>
   
    <div id = 'overview'>      
      <caption>Logbook(Green)<br>Requirement of Total 4500 mins (Include 900 mins nighttime)</caption><br>
      <div id = "progress">
        <label for = "green">T Completed: </label>
        <progress id = "completed" max = "4500", value=<?=$totalCompleted ?>></progress><a><?=$totalCompleted ?>/4500min</a><br> 
        <label for = "daytime">D Completed: </label>
        <progress id = "daytimeCompleted" max = "3600", value=<?=$daytimeCompleted ?>></progress><a><?=$daytimeCompleted ?>/3600min</a><br>
        <label for = "nighttime">N Completed: </label>
        <progress id = "nighttimeCompleted" max = "900", value=<?=$nighttimeCompleted ?>></progress><a><?=$nighttimeCompleted ?>/900min</a><br>   
      </div>
      <table id = "green">             
        <thead>           
          <tr><th colspan="4" class ="first">Daytime</th></tr>
          <tr><th></th><th>Completed</th><th>No Sign</th><th>Remaining</th></tr>
        </thead>
        <tbody>        
          <tr><th>Total(min)<td><?=$daytimeCompleted ?><td><?=$daytimeNosign ?><td><?=$daytimeRemaining ?></tr>          
        </tbody>
        <br>
        <thead>
          <tr><th colspan="4" class ="next">NightTime</th></tr>
          <tr><th></th><th>Completed</th><th>No Sign</th><th>Remaining</th></tr>
        </thead>
        <tbody>  
          <tr><th>Total(min)<td><?=$nighttimeCompleted ?><td><?=$nighttimeNosign ?><td><?=$nighttimeRemaining ?></tr>
        </tbody>
      </table> 
      <br><br>
      <caption>CBT/A(Yellow)</caption><br>
    </div>

  </body>
</html>