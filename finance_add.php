<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR QSD ADD RECORD" />
    <link rel = "stylesheet", type="text/css", href="styles/finance_add.css"> 
    <script src="scripts/logbook_add.js"></script>
    <script src="scripts/gps.js"></script>
    <title>New Invoice</title>
  </head>
  <body>
    <script>
        function closePage()
        {
            if(confirm("This page will be closed.\nAll information will be lost!"))
            {
                window.opener = null;
                window.open('','_self');
                window.close();
            }
        }
        function calculate()
        {
          
          var unit = document.getElementById("unit").value;
          var unitprice = document.getElementById("unitprice").value;
          var amount = (unit * unitprice).toFixed(2);
          document.getElementById("amount").value = amount;
          document.getElementById("tax").value = (amount * 0.1).toFixed(2);
          alert(amount);
        }
    </script>
    <?php
        $studentL = $_POST['studentL'];
        $payeeL = $_POST['userL'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where licence = '$studentL'";
        $result = mysqli_query($conn, $sql);        
        $firstname = "";
        $surname = "";
        $fullname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $surname = $row['surname'];
            $firstname = $row['firstname'];
            $studentfullname = $firstname." ". $surname;
          }
        }
        mysqli_free_result($result);
        $sql = "SELECT * FROM User where licence = '$payeeL'";
        $result = mysqli_query($conn, $sql);        
        $firstname = "";
        $surname = "";
        $userfullname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $surname = $row['surname'];
            $firstname = $row['firstname'];
            $userfullname = $firstname." ". $surname;
          }
        }
        mysqli_free_result($result);
    ?>
    <div id = "titleArea">
        <h2>To Student: <?=$studentfullname?> [<?=$studentL?>]</h2>
    </div>
    <div id = "dataArea">   
        <div id = "formData"> 
            <form  id = "formID" action="inc/finance_save.php" method="post"> 
                <input type = "hidden" name = "studentl" value="<?=$studentL?>">           
                <input type = "hidden" name = "studentname" value="<?=$studentfullname?>">
                <input type = "hidden" name = "payeel" value="<?=$payeeL?>">
                <input type = "hidden" name = "payeename" value="<?=$userfullname?>">
                <label>Date:</label><input class = "user" id = "currentdate" type = 'date' name = 'date' required><br><br>       
                <label>Desc:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                <select class = "user" name = "description">
                  <option value = "cbt training">CBT Training</option>
                  <option value = "assessment training">Assessment Training</option>
                  <option value = "logbook training">Logbook Training</option>
                </select><br><br>
                <label>Unit:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input class = "user" id = "unit" type = 'number' required name = 'unit' value = "1">&nbsp<label>hours</label><br><br>
                <label>UnitPrice: $</label><input class = "user" id = "unitprice" type = 'number' required name = 'unitprice' value = "100.00" onchange ="calculate()">&nbsp<label>/hour</label><br><br>
                <label>Amount:     &nbsp&nbsp$</label><input class = "user" id = "amount" type = "number" name = "amount" value = "100.00" required><br><br>
                <label>Tax: $ </label><input type = "text" name = "tax" id = "tax" value = "10.00" required readonly ><br><br>
                <script>init();</script>
                <input class = "user" type="submit" name = "submit" id = "submit" style ="width:100px; height:35px; text-align: center">
                <input class = "user" type="submit" name = "closesubmit" id = "closesubmit" value = "Close" style ="width:100px; height:35px; text-align: center" onclick="closePage()">
             </form>
        </div>
    
    </div>
    
  </body>
</html>

