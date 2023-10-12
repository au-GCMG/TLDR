<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="MAN PO ZHONG" />
        <meta name="description" content="TLDR govnment" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel = "stylesheet", type="text/css", href="styles/government.css">
        <title>Government</title>
    </head>
    <body>
        <?php
                session_start();
                $email = $_SESSION['email'];
                require_once "inc/dbconn.inc.php";
                $sql = "SELECT * FROM User where email = '{$email}'";
                $result = mysqli_query($conn, $sql);
                $firstname = "";
                if($result)
                {
                if(mysqli_num_rows($result) > 0)
                {
                    $row = mysqli_fetch_assoc($result);
                    $firstname = $row['firstname'];
                    echo "<h2>Welcome to Government $firstname</h2>";                  
                    require_once "inc/gov_menu.inc.php";
                    
                }
                }
            ?>
        
            <div id="record">
                <div>   
                <form action = "government.php" method="post">                
                    <br>
                    <input type = "text" name = "licence">
                    <BR>
                    <select name="userType">
                        <option value=""></option>
                        <option value="QSD">QSD</option>
                        <option value="Student">Student</option>
                        <option value="Instructor">Instructor</option>
                    </select>
                    <input type = "submit" name = "submit" value = "Search"><br>           
                </form>
                </div>
                <?php
                if(isset($_POST['submit']))
                {
                    $govUserL = strtoupper($_POST['licence']);
                    $userType = $_POST['userType'] == "" ? null : strtoupper($_POST['userType']);
                }
                else
                {
                    $govUserL = "";
                    $userType = null;
                }
                if($govUserL === "" && $userType === null)
                {
                    $sql = "SELECT * FROM User";
                }
                else if($govUserL !== "" && ($userType === "QSD" || $userType === "Student" || $userType === "Instructor"))
                {
                    $sql = "SELECT * FROM User where style = '$userType' and licence = '$govUserL' ";
                }
                else {
                    $sql = "SELECT * FROM User where style = '$userType' ";
                }
                require_once "inc/dbconn.inc.php";
                $result = mysqli_query($conn, $sql);
                if($result)
                {
                    if(mysqli_num_rows($result))
                    {
                        while($row = mysqli_fetch_assoc($result))
                        {
                            $UserLicence = $row['licence'];
                            $studentFirstname = $row['firstname'];
                            $studentSurname = $row['surname'];
                            echo  "<li> <a href = government.php?id=",base64_encode($UserLicence),">",$UserLicence,"-",$studentFirstname, " ",$studentSurname," </a></li>";
                        }
                    }               
                }
                
                mysqli_free_result($result);            
            ?>
            </div>

            <div id="recordDetails">
            <?php
            
            if(isset($_GET['id']))
            {
                $licence = base64_decode($_GET["id"]);
                echo "<h1> $licence </h1>";
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
                        $userType = $row['style'];

                        echo "<div id ='recordInfo'>";
                        echo '&nbsp&nbsp';
                        echo "<h3> $userType:  ".$firstname." ".$surname."</h3>";
                        echo '&nbsp&nbsp';
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

                        echo "</div>";                    
                        
                    }
                }
                mysqli_free_result($result);
            }
            //echo "<p>".base64_decode($_GET["id"])."</p>";
            //echo "<p>".$_GET["new"]."</p>";
          mysqli_close($conn);
        ?>               
            </div>
    </body>
</html>