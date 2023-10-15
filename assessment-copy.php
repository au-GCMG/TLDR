<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR ASSESSMENT" />
    <link rel = "stylesheet", type="text/css", href="styles/assessment.css">      
    <title>ASSESSMENT</title>
  </head>
  <body>
    <?php      
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $userlicence = "";
        $firstname = "";
        $loginstyle = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $userlicence = $row['licence'];
            $firstname = $row['firstname'];
            $loginstyle = $row['style'];
            echo "<h2>Welcome $firstname [$userlicence] -- $loginstyle</h2>";
          }
        }
        mysqli_free_result($result);
        //mysqli_close($conn);
    ?>
    <hr>
    <div id = "studentDetails">
        <?php
            if(isset($_GET['studentL']))
            {
                $licence = base64_decode($_GET['studentL']);
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
                        echo "<h3>Student:  ".$firstname." ".$surname."</h3>";
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
                            echo "<form  action = 'finance_add.php' method='post'>";
                            echo "<input type = 'hidden' name='studentL' value ='".$licence."'>";
                            echo "<input type = 'hidden' name='userL' value = '".$userlicence."'>";
                            //echo "<input id = 'newInvoice' type = 'submit' name = 'newInvoice' value = 'Add...'>";
                            echo "</form>";
                        }
                        else
                        {
                            echo "<h2 style = 'text-align: center'>Completed!</h2>";
                        } 
                        
                        echo "</div>";
                        echo "<hr><br>";

                        //add detail of assessment,instead of 'finance_detail.php' and put the php's file into the folder of inc
                        //require_once "inc/finance_detail.php";
                    }
                }
                mysqli_free_result($result);
            }
          mysqli_close($conn);
        ?>
      </div>
    </div>


  </body>
</html>