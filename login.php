<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR Login Page" />
    <link rel = "stylesheet", type="text/css", href="styles/login.css">
    <title>Login</title>
  </head>
  <body>
  <?php
    require_once "inc/dbconn.inc.php";
    $username = strtoupper($_POST["userName"]);
    //$password = $_POST["userPassword"];
    $password = md5($_POST["userPassword"]);
    
    $sql = "SELECT * FROM User where email = '".$username."'";
    $result = mysqli_query($conn, $sql);
    
    if($result)
    {
        if(mysqli_num_rows($result) > 0)//user found
        {
            $sql = "SELECT * FROM User where email = '".$username."' and password = '".$password."'";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                if(mysqli_num_rows($result) > 0)//user and password match
                {
                    $row = mysqli_fetch_assoc($result);
                    $style = $row['style'];

                    session_start();
                    $_SESSION['email'] = $username;
                    
                    switch($style)
                    {
                        case "STUDENT":
                            header("location: student.php");
                            break;
                        case "INSTRUCTOR":
                            header("location: instructor.php");
                            break;
                        case "QSD":
                            header("location: qsd.php");
                            break;
                        case "GOVERNMENT":
                            header("location: government.php");
                            break;
                    }
                }
                else
                {
                    echo "<a id = 'error'>The password incorrect!<br>The page will be return after 3 seconds.</a>";
                    mysqli_free_result($result);
                    mysqli_close($conn);
                    header("Refresh:3; login.html");
                }
            }           
            /*
            while($row = mysqli_fetch_assoc($result))
            {                
                echo  $row['firstname'];
            }
            */
        }
        else
        {
            echo "<a id = 'error'>The user is not Found!<br>The page will be return after 3 seconds.</a>";
            mysqli_free_result($result);
            mysqli_close($conn);
            header("Refresh:3; login.html");
        }
    }
    
    //mysqli_free_result($result);
    //mysqli_close($conn);

?>

  </body>
</html>
