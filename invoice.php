<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="Invoice" />
    <link rel = "stylesheet", type="text/css", href="styles/invoice.css">
    <title>Invoice</title>
  </head>
  <?php
    $id = $_GET["id"];
    require_once "inc/dbconn.inc.php";  

    $invoiceN = "";
    $invoicedate = "";
    $studentL = "";
    $studentname = "";
    $payeeL = "";
    $payeename = "";

    
    $studentaddress = "";
    $studentsuburb = "";
    $studentpost = "";
    $studentstate = "";
    //instructor information    
    
    $payeeaddress = "";
    $payeesuburb = "";
    $payeepost = "";
    $payeestate = "";

    $sql = "SELECT * FROM payment where id = '{$id}'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        $row = mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result) > 0)
        {                
            $studentL = $row['studentL'];
            $studentname = $row['studentName'];
            $payeeL = $row['payeeL'];
            $payeename = $row['payeeName'];
            $invoiceN = $row['invoiceN'];
            $date = $row['date'];
            $invoicedate = str_replace("-", "", $date);                           
        }
    }

  ?>
  <body>
    <div id = "invoiceTitle">
        <div id = "invoiceName">    
            <h4>TLDR Instructor</h4>
            <h4>Invoice</h4>
        </div>
        <div id = "invoiceInfo">
            <a>Invoice NO: </a><a><?=$invoiceN?></a><br>
            <a>Date: </a><a><?=$invoicedate?></a>        
        </div>
    </div>    
    <div id = "invoiceHead">
        <div id = "student">
            <a>TO:</a><br>
            <a><?=$studentname?></a><br>
            <a><?=$studentaddress?></a><br>
            <a><?=$studentsuburb?><?=$studentpost?></a><br>
            <a><?=$studentstate?></a>
        </div>
        
        <div id = "instructor">
            <a>From:</a><br>
            <a><?=$payeename?></a><br>
            <a><?=$payeeaddress?></a><br>
            <a><?=$payeesuburb?><?=$payeepost?></a><br>
            <a><?=$payeestate?></a>
        </div>
    </div>
    <hr>
    <div id = "invoiceTable">           
        <table id = "content">
            <thead>
                <tr>
                    <th style = "width: 15%">Description</th>
                    <th style = "width: 5%">Unit</th>
                    <th style = "width: 5%">Unit Price</th>
                    <th style = "width: 5%">Total price</th>
                </tr>                
            </thead>
            <tbody>
                <tr>
                    <th>This is a test</th>
                    <th>1</th>
                    <th>45.00</th>
                    <th>45.00</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div id = "invoiceFoot">
        <a >Total: </a><a>45.00</a><br>
        <a >Tax: </a><a>4.50</a>
    </div>
  </body>
</html>