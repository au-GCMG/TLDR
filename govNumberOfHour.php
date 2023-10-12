<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="MAN PO ZHONG" />
    <meta name="description" content="TLDR government" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/government.css">
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
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $firstname = $row['firstname'];
            echo "<h2>Welcome to Government $firstname</h2>";
            require_once "inc/gov_menu.inc.php";
        }
    }
    ?>
    <div id="record">
        <div>
            <form action="govNumberOfHour.php" method="post">
                <br>
                <input type="text" name="licence">
                <br>
                <input type="submit" name="submit" value="Search"><br>
            </form>
        </div>

        <?php
        $govUserL = isset($_POST['licence']) ? strtoupper($_POST['licence']) : "";
        $userType = "Instructor"; // Set userType to "Instructor" by default

        if (!empty($govUserL)) {
            // If something is entered in the text field, search for the specific instructor
            $result = mysqli_query($conn, "SELECT * FROM User WHERE style = '$userType' AND licence = '$govUserL'");

            if ($result && mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $UserLicence = $row['licence'];
                    $instructorFirstname = $row['firstname'];
                    $instructorSurname = $row['surname'];
                    echo  "<li> <a href='govNumberOfHour.php?id=", base64_encode($UserLicence), "'>", $UserLicence, "-", $instructorFirstname, " ", $instructorSurname, " </a></li>";
                }
            }
        } else {
            // If nothing is entered in the text field, show all instructors
            $result = mysqli_query($conn, "SELECT * FROM User WHERE style = '$userType'");

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $UserLicence = $row['licence'];
                    $instructorFirstname = $row['firstname'];
                    $instructorSurname = $row['surname'];
                    echo  "<li> <a href='govNumberOfHour.php?id=", base64_encode($UserLicence), "'>", $UserLicence, "-", $instructorFirstname, " ", $instructorSurname, " </a></li>";
                }
            }
        }

        mysqli_free_result($result);
        ?>
    </div>

    <div id="recordDetails">
    <?php
    if (isset($_GET['id'])) {
        $licence = base64_decode($_GET["id"]);
        echo "<h1> $licence </h1>";

        // Function to get instructor's information
        function getInstructorInfo($conn, $licence) {
            $sql = "SELECT * FROM User WHERE licence = '$licence'";
            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                return $row;
            }

            return null;
        }

        $instructorInfo = getInstructorInfo($conn, $licence);

        if ($instructorInfo !== null) {
            $firstname = $instructorInfo['firstname'];
            $surname = $instructorInfo['surname'];
            $code = $instructorInfo['code'];
            $userType = $instructorInfo['style'];

            echo "<div id ='recordInfo'>";
            echo '&nbsp&nbsp';
            echo "<h3> $userType:  " . $firstname . " " . $surname . "</h3>";
            echo '&nbsp&nbsp';
            echo "<p>";
            echo "Licence: " . $licence = $instructorInfo['licence'];
            echo '&nbsp&nbsp';
            echo "Issuing: " . $sc = $instructorInfo['sc'];
            echo '&nbsp&nbsp';
            echo "Expiry: " . $expiry = $instructorInfo['expiry'];
            echo '&nbsp&nbsp';
            echo "Held: " . $held = $instructorInfo['held'];
            echo "</p>";
            echo"<br>";

            echo "<p>";
            echo "Gender: " . $gender = $instructorInfo['gender'];
            echo '&nbsp&nbsp&nbsp&nbsp';
            echo "DOB: " . $dob = $instructorInfo['dob'];
            echo "</p>";

            echo "<p>";
            echo $address = $instructorInfo['address'] . ",";
            echo '&nbsp&nbsp';
            echo $suburb = $instructorInfo['suburb'] . ",";
            echo '&nbsp&nbsp';
            echo $state = $instructorInfo['state'] . "&nbsp";
            echo '&nbsp&nbsp';
            echo $post = $instructorInfo['post'];
            echo "</p>";

            echo "<p>";
            echo "Email: " . $email = $instructorInfo['email'];
            echo '&nbsp&nbsp&nbsp&nbsp';
            echo "Tel: " . $tel = $instructorInfo['tel'];
            echo '&nbsp&nbsp&nbsp&nbsp';
            echo "Mobile: " . $mobile = $instructorInfo['mobile'];
            echo "</p>";
            echo '&nbsp&nbsp&nbsp&nbsp';
            echo "<P>";

            $completed = $instructorInfo['completed'];

            echo "</div>";
        }

            // Calculate total time worked in minutes
            $sqlTotalTime = "SELECT SUM(duration) AS total_minutes FROM RecordGreen WHERE qsdLicence = '$licence'";
            $resultTotalTime = mysqli_query($conn, $sqlTotalTime);
            $totalMinutes = 0;

            if ($resultTotalTime && mysqli_num_rows($resultTotalTime) > 0) {
                $rowTotalTime = mysqli_fetch_assoc($resultTotalTime);
                $totalMinutes = $rowTotalTime['total_minutes'];
            }

            // Convert the total minutes to hours and minutes
            $totalHours = floor($totalMinutes / 60);
            $remainingMinutes = $totalMinutes % 60;

            // Display the total time worked in hours and minutes
            echo "<div id='totalTime'>";
            echo "<p>Total Time Worked: $totalHours hours $remainingMinutes minutes</p>";
            echo "<P>";
            echo "</div>";

            // Query 'RecordGreen' table for Date and working hours
            $sqlRecordGreen = "SELECT date, duration FROM RecordGreen WHERE qsdLicence = '$licence'";
            $resultRecordGreen = mysqli_query($conn, $sqlRecordGreen);

            if ($resultRecordGreen && mysqli_num_rows($resultRecordGreen) > 0) {
                echo "<div id='recordEntries'>";
                while ($rowRecordGreen = mysqli_fetch_assoc($resultRecordGreen)) {
                    $entryDate = $rowRecordGreen['date'];
                    $entryMinutes = $rowRecordGreen['duration'];

                    // Convert minutes to hours and minutes
                    $entryHours = floor($entryMinutes / 60);
                    $entryRemainingMinutes = $entryMinutes % 60;

                    // Apply the 'red' class if working hours are over 8 hours
                    $entryClass = ($entryMinutes > 480) ? 'red' : '';

                    echo "<p class='$entryClass'> - Date: $entryDate, Working Hours: $entryHours hours $entryRemainingMinutes minutes</p>";
                }
                echo "</div>";
            }

            mysqli_free_result($resultRecordGreen);
        
    }
    ?>
</div>

</body>
</html>


