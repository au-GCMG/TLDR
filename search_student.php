<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD" />
    <link rel = "stylesheet", type="text/css", href="styles/search_student.css">    
    <title>student-search</title>
  </head>
  <body>
    <script type = "text/javascript">
        function checkcode(code, sl, ls)
        {
            var inputcode = prompt("Enter the verification code:", "code");            
            if(inputcode != code)
            {
                alert("Your aren't authorized! Please contact to the student.");
                self.location = 'search_student.php';
            }
            else
            {
                if(ls == "QSD")
                {
                    var url= "logbook.php?studentL=" + sl;
                    window.open(url);
                }
                else
                {
                    if(ls == "INSTRUCTOR")
                    {
                        var url= "student_info.php?studentL=" + sl;
                        window.open(url);
                    }
                }
                
            }
        }
        function next(sl, ls)
        {
            if(ls == "QSD")
            {
                var url= "logbook.php?studentL=" + sl;
                 window.open(url);
            }
            else
            {
                if(ls == "INSTRUCTOR")
                {
                    var url= "student_info.php?studentL=" + sl;
                    window.open(url);
                }
            }
        }
    </script>
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
            echo "<h2>Welcome $firstname [$userlicence] -- $loginstyle&nbsp&nbsp&nbsp<a style = 'color:red' href='login.html'>Logout</a></h2>";
            echo "<hr>";
        }
        }
        mysqli_free_result($result);
        echo "<br>";
        echo "<div id = 'searchlist'>";

        echo "<div id = 'searchoption'>";
        echo "<form  action = 'search_student.php' method = 'post'>";
        echo "<label>Licence NO. </label>";
        echo "<input  style = 'font-size:larger;font-size:large; width:300px; height:40px' type = 'text' name = 'studentL'> <br><br>";
        echo "<input style = 'font-size: larger;font-size: large;' type = 'submit' value = 'Search'>";
        echo "</form>";
        echo "</div>";

        echo "<table id = 'studentlist'>";
        echo "<thead>";
        echo "<tr>";
            echo "<th style = 'width: 7%'>Licence</th>";
            echo "<th style = 'width: 15%'>Name</th>";
            echo "<th style = 'width: 7%'>Access</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $studentLicence = "";
        if(isset($_POST['studentL']))
        {
            $studentLicence = strtoupper($_POST['studentL']);
            if($studentLicence != "")
            {
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$userlicence' and studentL = '$studentLicence' GROUP BY studentL";
            }
            else
            {
                $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$userlicence' GROUP BY studentL";
            }
        }
        else
        {
            $sql = "SELECT studentL, studentName FROM recordGreen where qsdLicence = '$userlicence' GROUP BY studentL";
        }
        
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            if(mysqli_num_rows($result))
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $studentL = base64_encode($row['studentL']);
                    $studentname = $row['studentName'];
                        
                    echo "<tr>";
                    echo "<th style = 'width: 7%'>",base64_decode($studentL),"</th>";     
                    echo "<th style = 'width: 5%'>",$studentname,"</th>";
                        
                    echo "<th style = 'width: 5%'>";
                    echo "<form>";
                    echo ('<input type = "button" style = "width:100px; height:30px" value = "Access" onclick="next(\''.$studentL.'\',\''.$loginstyle.'\')">');
                    echo "</form>";
                    echo "</th>";
                    echo "</tr>";
                }                    
            }
            else
            {
                $sql = "SELECT firstname, surname, licence, code FROM user where licence = '$studentLicence' and style = 'STUDENT'";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    if(mysqli_num_rows($result))
                    {
                        $row = mysqli_fetch_assoc($result);
                        $studentL = base64_encode($row['licence']);
                        $studentname = $row['firstname']." ".$row['surname'];
                        $code = $row['code'];
                        echo "<tr>";
                        echo "<th  class = 'newstudent' style = 'width: 7%'>",base64_decode($studentL),"</th>";     
                        echo "<th style = 'width: 5%'>",$studentname,"</th>";
                            
                        echo "<th style = 'width: 5%'>";
                        echo "<form>";
                        echo ('<input type = "button" style = "width:100px; height:30px" value = "Access" onclick="checkcode(\''.$code.'\',\''.$studentL.'\',\''.$loginstyle.'\')">');
                        echo "</form>";
                        echo "</th>";
                        echo "</tr>";
                    }
                }    
            }
        }
        echo "</div>";
    mysqli_free_result($result);
    echo "</tbody>";
    echo "</table>";
    ?>
  </body>
</html>