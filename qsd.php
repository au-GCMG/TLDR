<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD" />
    <link rel = "stylesheet", type="text/css", href="styles/qsd.css">    
    <title>QSD</title>
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
            echo "<h2>Welcome QDS ---- $firstname [$licence]</h2>"; 
          }
        }
        mysqli_free_result($result);
        //mysqli_close($conn);
    ?>
    <hr>
    <div id = "student">
        <div>   
            <form action = "qsd.php" method="post">                
                <br>
                <input type = "text" name = "licence">
                <input type = "submit" name = "submit" value = "Search"><br>                
            </form>
        </div> 
        <?php
            if(isset($_POST['submit']))
            {
                $studentL = strtoupper($_POST['licence']);
            }
            else
            {
                $studentL = "";
            }

            if($studentL == "")
            {
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$licence' GROUP BY studentL";
            }
            else
            {
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$licence' and studentL = '$studentL' GROUP BY studentL";
            }
            require_once "inc/dbconn.inc.php";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                if(mysqli_num_rows($result))
                {
                    while($row = mysqli_fetch_assoc($result))
                    {
                        $studentL = $row['studentL'];
                        $studentname = $row['studentName'];
                        //echo "<li><a href = qsdStudent.php>",$studentL,"-",$studentname,"</a><li>";
                        echo  "<li> <a href = qsd.php?id=",base64_encode($studentL),"&new=0",">",$studentL,"-",$studentname," </a></li>";
                    }
                    
                }
                else
                {
                    //no find in record, maybe he/she is a new student.
                    //search in User 
                    $sql = "SELECT firstname, surname, licence FROM user where licence = '$studentL' and style = 'STUDENT'";
                    $result = mysqli_query($conn, $sql);
                    if($result)
                    {
                        if(mysqli_num_rows($result))
                        {
                            $row = mysqli_fetch_assoc($result);
                            $studentL = $row['licence'];
                            $studentname = $row['firstname']." ".$row['surname'];
                            echo  "<li> <a class = 'newstudent' href = qsd.php?id=",base64_encode($studentL),"&new=1",">",$studentL,"-",$studentname," </a></li>";
                        }
                    }                    
                }
            }
            
            mysqli_free_result($result);
            mysqli_close($conn);
        ?>
    </div>
    <div id = "studentDetails">
        <?php
          if(isset($_GET["id"]))
          {
            echo "<p>".base64_decode($_GET["id"])."</p>";
            echo "<p>".$_GET["new"]."</p>";
          } 
          //check completed
           
        ?>
    </div>
    
  </body>
</html>