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
    $mdi = "";
    $complete = 0;
    $style = strtoupper($_POST['userStyle']);

    

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
            //Get mdi if style is instructor
            if($style == 'INSTRUCTOR')
            {
                $sql = "SELECT * FROM instructor where licence = '{$DL}'";
                $result2 = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result2) > 0)
                {
                    $row = mysqli_fetch_assoc($result2);
                    $mdi = strtoupper($row['mdi']);
                    mysqli_free_result($result2);
                } 
                else
                {
                    echo"<a id = 'error'>You are not be authorized!<br>Please contact to 000<br>The page will be return after 5 seconds.</a>";
                    header("Refresh:5; login.html");
                    mysqli_free_result($result1);
                    mysqli_free_result($result2);
                    mysqli_close($conn);
                    return;
                }               
            }
            $sql = "INSERT INTO User (firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,mdi,completed,style) VALUES";
            $sql.= "('{$firstname}', '{$surname}', '{$password}','{$gender}','{$dob}','{$address}','{$suburb}','{$state}','{$postcode}','{$email}','{$tel}','{$mobile}','{$DL}','{$mdi}','{$complete}','{$style}')";
            $result3 = mysqli_query($conn, $sql);
            if($result3)
            {
                echo"<a id = 'OK'>Congratulation on your succcessful registration!<br>The page will be return to login after 5 seconds.</a>";
                header("Refresh:5; login.html");
            }
        }        
    }
    mysqli_free_result($result1);
    mysqli_close($conn);
    ?>
  </body>
</html>