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
        require_once "inc/student_overview.php";
    ?>
   
    <div id = 'overview'>      
      <caption>MY LOGBOOK(Green)<br>Requirement of Total 4500 mins (Include 900 mins nighttime)</caption><br>
      <br>
      <div id = "progress">
        <label>Total: Completed: </label>
        <progress id = "completed" max = "4500", value=<?=$totalCompleted ?>></progress>&nbsp&nbsp<a><?=$totalCompleted ?>/4500min</a><br> 
        <label>Day&nbsp&nbsp: Completed: </label>
        <progress id = "daytimeCompleted" max = "3600", value=<?=$daytimeCompleted ?>></progress>&nbsp&nbsp<a><?=$daytimeCompleted ?>/3600min</a><br>
        <label>Night: Completed: </label>
        <progress id = "nighttimeCompleted" max = "900", value=<?=$nighttimeCompleted ?>></progress>&nbsp&nbsp<a><?=$nighttimeCompleted ?>/900min</a><br>   
      </div>
      <br>
      <table id = "green">             
        <thead>           
          <tr><th colspan="4" class ="first">Daytime</th></tr>
          <tr><th></th><th>Completed</th><th>Remaining</th><th>No Sign</th></tr>
        </thead>
        <tbody>        
          <tr><th>Total(min)<td><?=$daytimeCompleted ?><td><?=$daytimeRemaining ?><td><?=$daytimeNosign ?></tr>          
        </tbody>
        <br>
        <thead>
          <tr><th colspan="4" class ="next">NightTime</th></tr>
          <tr><th></th><th>Completed</th><th>Remaining</th><th>No Sign</th></tr>
        </thead>
        <tbody>  
          <tr><th>Total(min)<td><?=$nighttimeCompleted ?><td><?=$nighttimeRemaining ?><td><?=$nighttimeNosign ?></tr>
        </tbody>
      </table> 
      <br><a style = "font-size:small">*please click 'myLogbook' for details</a>

      <br><br>
      <hr>

      <caption>MY CBT(Yellow)</caption><br>
      <div id = "progress">
        <label>Units Completed: </label>
        <progress id = "unitCompleted" max = "4", value=<?=$totalCompleted ?>></progress>&nbsp&nbsp<a><?=$totalCompleted ?>/4</a><br> 
        <label>Tasks Completed: </label>
        <progress id = "taskCompleted" max = "32", value=<?=$daytimeCompleted ?>></progress>&nbsp&nbsp<a><?=$daytimeCompleted ?>/32</a><br>
        <label>Items Completed: </label>
        <progress id = "itemCompleted" max = "250", value=<?=$nighttimeCompleted ?>></progress>&nbsp&nbsp<a><?=$nighttimeCompleted ?>/250</a><br>   
      </div>
      <br><br>
      <table id = "yellow">             
        <thead>           
          <tr><th colspan="4" class ="cbt">CBT</th></tr>
          <tr><th></th><th>Completed</th><th>Incompleted</th><th>No Sign</th></tr>
        </thead>
        <tbody>        
          <tr><th>Units<td><?=$daytimeCompleted ?><td><?=$daytimeRemaining ?><td><?=$daytimeNosign ?></tr>
          <tr><th>Tasks<td><?=$daytimeCompleted ?><td><?=$daytimeRemaining ?><td><?=$daytimeNosign ?></tr> 
          <tr><th>Items<td><?=$daytimeCompleted ?><td><?=$daytimeRemaining ?><td><?=$daytimeNosign ?></tr>           
        </tbody>        
      </table> 
      <br><a style = "font-size:small">*please click 'myCBT' for details</a>

      <br><br>
      <hr>
      
      <caption>MY PAYMENT</caption><br>
      <table id = "pink">
      <thead>
        <tr><th colspan="4" class ="payment">Summary</th></tr>
        <tr><th></th><th>Paid</th><th>Unpaid</th><th>Total</th></tr>
      </thead>
      <tbody>
        <tr><th>Amount($)<td><?=$totalPaid ?><td><?=$totalUnpaid ?><td><?=$totalAmount ?></tr>
      </tbody>
      </table>
      <br><a style = "font-size:small">*please click 'myFinance' for details</a>

  </body>
</html>