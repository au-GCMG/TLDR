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
            <form action="gov_payment_check.php" method="post">
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
                    echo  "<li> <a href='gov_payment_check.php?id=", base64_encode($UserLicence), "'>", $UserLicence, "-", $instructorFirstname, " ", $instructorSurname, " </a></li>";
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
                    echo  "<li> <a href='gov_payment_check.php?id=", base64_encode($UserLicence), "'>", $UserLicence, "-", $instructorFirstname, " ", $instructorSurname, " </a></li>";
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
            // Display instructor's information (as before)
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
            echo "<br>";

            echo "<p>";
            echo "Gender: " . $gender = $instructorInfo['gender'];
            echo '&nbsp&nbsp&nbsp&nbsp';
            echo "DOB: " . $dob = $instructorInfo['dob'];
            echo "</p>";

            $completed = $instructorInfo['completed'];

            echo "</div>";

            // Query 'payment' table for payment data
            $sqlpayment = "SELECT date, invoiceN, description, unitprice, unit, amount FROM payment WHERE payeeL = '$licence'";
            $sqlpaym = "SELECT * FROM `payment` WHERE licence = '$licence'";
            $resultPayment = mysqli_query($conn, $sqlpayment);

            if ($resultPayment && mysqli_num_rows($resultPayment) > 0) {
                echo "<div id='paymentEntries'>";
                echo "</p>";
                echo '&nbsp&nbsp&nbsp&nbsp';
                echo "<h2>Payment Information</h2>";
                echo "</p>";
                echo "<table cellpadding='1'>";
                echo "<tr><th>Date</th><th>Invoice Number</th><th>Description</th><th>Unit Price</th><th>Unit</th><th>Amount</th></tr>";
                // Add an empty row with non-breaking spaces
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
                while ($rowPayment = mysqli_fetch_assoc($resultPayment)) {
                    echo "<tr>";
                    echo "<td>" . $rowPayment['date'] ."&nbsp;&nbsp;". "</td>";
                    echo "<td>" . $rowPayment['invoiceN'] ."&nbsp;&nbsp;&nbsp&nbsp;". "</td>";
                    echo "<td>" . $rowPayment['description'] ."&nbsp;&nbsp;&nbsp&nbsp;". "</td>";
                    echo "<td>" . $rowPayment['unitprice'] ."&nbsp;&nbsp;&nbsp&nbsp;". "</td>";
                    echo "<td>" . $rowPayment['unit'] ."&nbsp;&nbsp;&nbsp&nbsp;"." </td>";
                    echo "<td>" . $rowPayment['amount'] . "</td>";
                    echo "</tr>";

                    echo "<tr><td colspan='6'>&nbsp;</td></tr>"; 
                    echo "<tr><td colspan='6'>&nbsp;</td></tr>";
                    echo "<tr><td colspan='6'>&nbsp;</td></tr>";
                }
                echo "</table>";

                echo "</div>";
            }

            mysqli_free_result($resultPayment);
        }
    }
    ?>
</div>

</body>
</html>


