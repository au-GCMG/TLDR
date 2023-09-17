<?php
    require_once "inc/dbconn.inc.php";

    // Add your code here
    
    
    $username = $_POST["userName"];
    $password = $_POST["userPassword"];
    //$password = md5($_POST["userPassword"]);

    $sql = "SELECT * FROM User where email = '".$username."' and password = '".$password."'";
    
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        if(mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
            $style = $row['style'];
            switch($style)
            {
                case "STUDENT":
                    header("location: student.html");
                    break;
                case "INSTRUCTOR":
                    header("location: instructor.html");
                    break;
                case "PARENT(QSD)":
                    header("location: qsd.html");
                    break;
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
            echo "The user is not Found or password incorrect!<br>The page will be return after 3 seconds.";
            header("Refresh:3; login.html");
        }
    }
    mysqli_free_result($result);
    mysqli_close($conn);

?>