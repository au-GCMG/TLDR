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
        mysqli_close($conn);
    ?>
    <div id = 'overview'>
      <caption>logbook(Green)<br>Requirement of Total 4500 mins</caption>      
      <table id = "green">             
        <tbody>           
          <tr><th colspan="4" class ="first">Daytime</th>
          <tr><th><th>Completed<th>No Sign<th>Remaining</tr>        
          <tr><th>Total(min)<td>cell1.1<td>cell1.2<td>cell1.3</tr>          
        </tbody>
        <br>
        <tbody>
          <tr><th colspan="4" class ="next">NightTime</th>
          <tr><th><th>Completed<th>No Sign<th>Remaining</tr>  
          <tr><th>Total(min)<td>cel3.1<td>cell3.2<td>cell3.3</tr>
        </tbody>
      </table> 
    </div>

  </body>
</html>