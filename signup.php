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
    $DL = $_POST['userDL'];
    $complete = 0;
    $style = strtoupper($_POST['userStyle']);

    $sql = "INSERT INTO User (firstname,surname,password,gender,dob,address,suburb,state,post,email,tel,mobile,licence,completed,style) VALUES";
    $sql.= "('{$firstname}', '{$surname}', '{$password}','{$gender}','{$dob}','{$address}','{$suburb}','{$state}','{$postcode}','{$email}','{$tel}','{$mobile}','{$DL}','{$complete}','{$style}')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header("location: login.html");
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>