<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD" />
    <link rel = "stylesheet", type="text/css", href="styles/qsd.css">    
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
          }
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    ?>
  </body>
</html>