<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR signup Page PHP" />
    <link rel = "stylesheet", type="text/css", href="styles/signup.css">
    <title>Signup</title>
  </head>
  <body>
    
    <?php
    
    require_once "inc/dbconn.inc.php";    
    $firstname = strtoupper($_POST['userFirstname']);
    $surname = strtoupper($_POST['userSurname']);
    $gender = $_POST['userGender'];
    $password = md5($_POST['userPassword']);
    $dob = $_POST['userDOB'];
    $address = $_POST['userAddress'];
    $suburb = $_POST['userSuburb'];
    $state = $_POST['userState'];
    $postcode = $_POST['userPOST'];
    $email = strtoupper($_POST['userEmail']);
    $tel = $_POST['userTel'];
    $mobile = $_POST['userMobile'];
    $DL = strtoupper($_POST['userDL']);
    $sc = strtoupper($_POST['userCountry']);
    $expiry = $_POST['userExpiry'];
    $held = $_POST['userHeld'];
    $mdi = "";
    $complete = 0;
    $style = strtoupper($_POST['userStyle']);

    //check the licence belongs to SA(yes-Get information from sys_SALicence table)
    $sql = "SELECT * FROM sys_SALicence WHERE licence = '{$DL}'";
    $resultSA = mysqli_query($conn, $sql);
    if($resultSA)
    {
        if(mysqli_num_rows($resultSA) > 0)
        {
            $row = mysqli_fetch_assoc($resultSA);
            $sc = "SA";
            $expiry = $row['expiry'];
            $held = $row['held'];
        }
    }
    mysqli_free_result($resultSA);

    //check the email's uniqueness
    $sql = "SELECT email FROM User WHERE email ='{$email}'";
    $result1 = mysqli_query($conn, $sql);
    if($result1)
    {
        if(mysqli_num_rows($result1) > 0)
        {
            //echo "<a id='error'>This user has existed already!<br>The page will be return after 5 seconds.</a>";
            //header("Refresh:5; signup.html");
            echo "<script>alert('This user has existed already!'); history.go(-1);</script> ";
        }
        else
        {
            //if style is student, check age and licence's type from sys_SALicence
            if($style == 'STUDENT')
            {
                $currentDate = date("Y-m-d");
                $timestamp1 = strtotime($dob);
                $timestamp2 = strtotime($currentDate);
                $different = abs((date('Y',$timestamp1) - date('Y',$timestamp2))*12 + (date('m',$timestamp1) - date('m',$timestamp2)));
                
                if($different > 780 || $different < 180)
                {                    
                    echo"<a id = 'error'>Your AGE is NOT eligible!<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                    header("Refresh:5; login.html");
                    mysqli_free_result($result1);
                    mysqli_close($conn);
                    return;
                }



                $sql = "SELECT * FROM sys_salicence WHERE licence = '{$DL}'";
                $resultSA = mysqli_query($conn, $sql);
                if($resultSA)
                {
                    if(mysqli_num_rows($resultSA) <= 0)
                    {
                        echo"<a id = 'error'>Your licence number is INVALID/not belong to SA!<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                        header("Refresh:5; login.html");
                        mysqli_free_result($resultSA);
                        return;
                    }
                    else
                    {
                        $row = mysqli_fetch_assoc($resultSA);
                        if($row['style'] != "L")
                        {
                            echo"<a id = 'error'>Your licence is NOT a Leaning Plate ! You don't need to learn.<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                            header("Refresh:5; login.html");
                            mysqli_free_result($resultSA);
                            return;
                        }
                    }
                }
                mysqli_free_result($resultSA);

            }

            //if style is QSD, the licence's type must be F from sysSALicence
            if($style == "QSD")
            {
                $sql = "SELECT * FROM sys_salicence WHERE licence = '{$DL}'";
                $resultSA = mysqli_query($conn, $sql);
                if($resultSA)
                {
                    if(mysqli_num_rows($resultSA) > 0)
                    {
                        $row = mysqli_fetch_assoc($resultSA);
                        if($row['style'] != "F")
                        {
                            echo"<a id = 'error'>Your licence is NOT FULL LICENCE! You cann't be a QSD.<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                            header("Refresh:5; login.html");
                            mysqli_free_result($resultSA);
                            return;
                        }
                    }
                    else
                    {
                        echo"<a id = 'error'>Your licence number is INVALID!<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                        header("Refresh:5; login.html");
                        mysqli_free_result($resultSA);
                        return;
                    }
                }
                mysqli_free_result($resultSA);
            }

            //Get mdi if style is instructor assume the instructor has obtained the full licence.
            if($style == 'INSTRUCTOR')
            {
                $sql = "SELECT * FROM sys_instructor where licence = '{$DL}'";
                $result2 = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result2) > 0)
                {
                    $row = mysqli_fetch_assoc($result2);
                    $mdi = strtoupper($row['mdi']);
                    mysqli_free_result($result2);
                } 
                else
                {
                    echo"<a id = 'error'>You are NOT be authorized!<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                    header("Refresh:5; login.html");
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_close($conn);
                    return;
                }               
            }
            $sql = "INSERT INTO User (firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,sc,expiry,held,mdi,completed,style) VALUES";
            $sql.= "('{$firstname}', '{$surname}', '{$password}','{$gender}','{$dob}','{$address}','{$suburb}','{$state}','{$postcode}','{$email}','{$tel}','{$mobile}','{$DL}','{$sc}','{$expiry}','{$held}','{$mdi}','{$complete}','{$style}')";
            $result3 = mysqli_query($conn, $sql);
            if($result3)
            {
                echo"<a id = 'OK'>Congratulation on your succcessful registration!<br>The page will be return to login after 3 seconds.</a>";
                header("Refresh:3; login.html");
            }
        }        
    }
    mysqli_free_result($result1);
    mysqli_close($conn);
    ?>
  </body>
</html>