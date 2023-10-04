<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR Instructor-main" />
    <link rel = "stylesheet", type="text/css", href="styles/instructor.css">    
    <title>Instructor</title>
  </head>
  <body>
    <br>
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
        echo "<h2>Welcome Instructor $firstname ($licence)</h2>";        
      }
    }
    mysqli_free_result($result);
    mysqli_close($conn);
    ?>
    <br>
    <hr>
    <br>
    <div>
        <form id = "buttonArea">
            <input type = "button"  onclick="window.open('qsd.php')" id = "logbook" class = "instructorButton" value="Logbook-Record" style = "background-color: green;"><br><br>
            <input type = "button" id = "cbt" class = "instructorButton" value="CBT-Record" style = "background-color: orangered;"><br><br>
            <input type = "button" id = "invoice" class = "instructorButton" value = "Invocie" style = "background-color: pink;">
        </form>
    </div>

  </body>
</html>