<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="TLDR student finance" />
    <link rel = "stylesheet", type="text/css", href="styles/student.css">
    <link rel = "stylesheet", type="text/css", href="styles/myfinance.css">
    <script src="scripts/studentMenu.js" defer></script>
    <title>Student</title>
  </head>
  <body>
    <?php
        session_start();
        $email = $_SESSION['email'];
        require_once "inc/dbconn.inc.php";
        $sql = "SELECT * FROM User where email = '{$email}'";
        $result = mysqli_query($conn, $sql);
        $licence = "";
        $firstname = "";
        if($result)
        {
          if(mysqli_num_rows($result) > 0)
          {
            $row = mysqli_fetch_assoc($result);
            $licence = $row['licence'];
            $firstname = $row['firstname'];
            echo "<h2>Welcome $firstname ($licence)</h2>";                       
            require_once "inc/menu.inc.php";
          }
        }
        mysqli_free_result($result);
    ?>
    <h4>Record of Payment</h4>
        <table id = 'paymentRecord'>
          <thead>
            <tr>
              <th style = "width: 7%" rowspan="2">Date</th>
              <th style = "width: 7%"rowspan="2">No.</th>
              <th style = "width: 37%"rowspan="2">Description</th>
              <th style = "width: 7"colspan="2">UNIT</th>
              <th style = "width: 7%"rowspan="2">Amount</th>
              <th style = "width: 5%"rowspan="2">Tax</th>              
              <th style = "width: 13%"rowspan="2">Payee</th>
              <th style = "width: 7%"rowspan="2">Paid</th>
              <th style = "width: 15%"rowspan="2">Invoice</th>
            </tr>
            <tr>
              <th style = "width: 7%">Price</th>
              <th style = "width: 7%">Unit(H)</th>              
            </tr>
          </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM payment where studentL = '{$licence}' order by date";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
              if(mysqli_num_rows($result) > 0)
              {
                while ($row = mysqli_fetch_assoc($result))
                {
                  echo "<tr>";
                  echo "<th style = 'width: 7%'>",$row['date'],"</th>";     
                  echo "<th style = 'width: 7%'>",$row['invoiceN'],"</th>";
                  echo "<th style = 'width: 37%'>",$row['description'],"</th>";
                  echo "<th style = 'width: 7%'>",$row['unitprice'],"</th>";
                  echo "<th style = 'width: 7%'>",$row['unit'],"</th>";
                  echo "<th style = 'width: 7%'>",$row['amount'],"</th>";
                  echo "<th style = 'width: 5%'>",$row['tax'],"</th>";                  
                  echo "<th style = 'width: 13%'>",$row['payeeName'],"</th>";
                  if($row['paid'] == 0)
                  {
                      echo "<th style = 'width: 7%; background-color: pink'>";
                      echo "<a style = 'background-color: pink' href = inc/pay.php?id=",$row['id'],">Pay</a>";
                      echo "</th>";                      
                  }
                  else
                  {
                      echo "<th style = 'width: 7%'>Y</th>";
                  }                  
                  echo "<th style = 'width: 15%'>";
                      echo "<form name = 'invoice' action='invoice.php' method='get' target='_blank'>";
                          echo "<input type = 'hidden' name = 'id' value = ",$row['id'],">";
                          echo "<input type = 'submit' value='Invoice'>";
                      echo "</form>";
                  echo "</th>";
                  echo "</tr>";
                }
              }
            }

            mysqli_free_result($result);
            mysqli_close($conn);
          ?>
        </tbody>
        </table>

    

  </body>
</html>