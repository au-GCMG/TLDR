<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD" />
    <link rel = "stylesheet", type="text/css", href="styles/qsd.css">    
    <title>QSD</title>
  </head>
  <body>
    <script type = "text/javascript">
        function checkcode(code)
        {
            var inputcode = prompt("Enter the verification code:", "code");            
            if(inputcode != code)
            {
                alert("Your aren't authorized! Please contact to the student.");
                self.location = 'qsd.php';
            }
        }
    </script>
    <?php      
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $qsdlicence = "";
        $firstname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $qsdlicence = $row['licence'];
            $firstname = $row['firstname'];
            echo "<h2>Welcome QDS ---- $firstname [$qsdlicence]&nbsp&nbsp&nbsp<a style = 'color:red' href='login.html'>Logout</a></h2>";
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
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$qsdlicence' GROUP BY studentL";
            }
            else
            {
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$qsdlicence' and studentL = '$studentL' GROUP BY studentL";
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
                            echo  "<li> <a  class = 'newstudent' href = qsd.php?id=",base64_encode($studentL),"&new=1",">",$studentL,"-",$studentname," </a></li>";
                        }
                    }                    
                }
            }
            
            mysqli_free_result($result);            
        ?>
    </div>
    <div id = "studentDetails">
        <?php
            if(isset($_GET['id']) && isset($_GET['new']))
            {
                $licence = base64_decode($_GET["id"]);
                //Get student's information 
                $sql = "SELECT * FROM User where licence = '$licence'";
                $result = mysqli_query($conn, $sql);
            
                $firstname = "";
                $surname = "";
                $gender = "";
                $dob = "";
                $address = "";
                $suburb = "";
                $state = "";
                $post = "";
                $email = "";
                $tel = "";
                $mobile = "";
                $licence = "";
                $sc = "";
                $expiry = "";
                $held = "";
                $completed = 0;
                $code = "";

                if($result)
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_assoc($result);

                        $firstname =$row['firstname'];
                        $surname = $row['surname'];
                        $code = $row['code'];
                        
                        echo "<div id ='studentInfo'>";
                        if($_GET['new'] == 0)
                        {
                            echo "<h3>Student:  ".$firstname." ".$surname."</h3>";
                        }
                        else
                        {                            
                            echo "<h3>Welcome New Student:  ".$firstname." ".$surname."</h3>";
                            //check authorization
                            echo "<script type = 'text/javascript'>checkcode(".$code.");</script>";                            
                        }
                        echo "<p>";
                        echo "Licence: ".$licence = $row['licence'];
                        echo '&nbsp&nbsp';
                        echo "Issuing: ".$sc = $row['sc'];
                        echo '&nbsp&nbsp';
                        echo "Expiry: ".$expiry = $row['expiry'];
                        echo '&nbsp&nbsp';
                        echo "Held: ".$held = $row['held'];
                        echo "</p>";
                        echo"<br>";

                        echo "<p>";
                        echo "Gender: ".$gender = $row['gender'];
                        echo '&nbsp&nbsp&nbsp&nbsp';
                        echo "DOB: ".$dob = $row['dob'];
                        echo "</p>";
                           
                        echo "<p>";
                        echo $address = $row['address'].",";
                        echo '&nbsp&nbsp';
                        echo $suburb = $row['suburb'].",";
                        echo '&nbsp&nbsp';
                        echo $state = $row['state']."&nbsp";
                        echo '&nbsp&nbsp';
                        echo $post = $row['post'];
                        echo "</p>";

                        echo "<p>";
                        echo "Email: ".$email = $row['email'];
                        echo '&nbsp&nbsp&nbsp&nbsp';
                        echo "Tel: ".$tel = $row['tel'];   
                        echo '&nbsp&nbsp&nbsp&nbsp';                     
                        echo "Mobile: ".$mobile = $row['mobile'];
                        echo "</p>";

                        
                        $completed = $row['completed'];
                        if($completed == 0)
                        {
                            echo "<form  action = 'addRecord.php' method='post'>";
                            echo "<input type = 'hidden' name='studentL' value ='".$licence."'>";
                            echo "<input type = 'hidden' name='qsdL' value = '".$qsdlicence."'>";
                            echo "<input id = 'record' type = 'submit' name = 'record' value = 'Record...' target = '_blank'>";
                            echo "</form>";
                        }
                        else
                        {
                            echo "<h2 style = 'text-align: center'>Completed!</h2>";
                        } 
                        
                        echo "</div>";

                        require_once "inc/qsd_student.php";                        
                        
                    }
                }
                mysqli_free_result($result);
            }
            //echo "<p>".base64_decode($_GET["id"])."</p>";
            //echo "<p>".$_GET["new"]."</p>";
          mysqli_close($conn);
        ?>


        
      
    </div>
    </div>
    

  </body>
</html>