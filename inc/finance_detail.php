<?php
    $totalAmount = 0.00;
    $totalPaid = 0.00;
    $totalUnpaid = 0.00;
 
    $sql = "SELECT SUM(amount) AS totalAmount FROM payment where studentL = '{$licence}' and payeeL = '{$userlicence}' and paid = '1'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      if(mysqli_num_rows($result) > 0)
      {
        $row = mysqli_fetch_assoc($result);
        $totalPaid= $row['totalAmount'];
        if($totalPaid == "")
        {
            $totalPaid = 0.00;
        }           
      }
      else
      {
        $totalPaid = 0.00;
      }
    }
    else
    {
        $totalPaid= 0.00;
    }
    mysqli_free_result($result);
    $sql = "SELECT SUM(amount) AS totalAmount FROM payment where studentL = '{$licence}' and payeeL = '{$userlicence}' and paid = '0'";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
      if(mysqli_num_rows($result) > 0)
      {
        $row = mysqli_fetch_assoc($result);
        $totalUnpaid = $row['totalAmount']; 
        if($totalUnpaid == "")
        {
            $totalUnpaid = 0.00;
        }       
      }
      else
      {
        $totalUnpaid = 0.00;
      }
    }
    else
    {
        $totalUnpaid = 0.00;
    }
    $totalAmount = $totalPaid + $totalUnpaid;
    echo "<div id = 'overview'>";     
    echo "<p>Total: $ $totalAmount<p>";
    echo "<p>Paid: $ $totalPaid<p>";
    echo "<p>Unpaid: $ $totalUnpaid<p>";
    echo "</div>";
    echo "<br>";

    mysqli_free_result($result);
////////////////////////////////////////////////////////////////////////////
    echo "<table id = 'paymentRecord'>";
        echo "<thead>";
        echo "<tr>";
            echo '<th style = "width: 7%" rowspan="2">Date</th>';
            echo '<th style = "width: 7%"rowspan="2">No.</th>';
            echo '<th style = "width: 37%"rowspan="2">Description</th>';
            echo '<th style = "width: 7"colspan="2">UNIT</th>';
            echo '<th style = "width: 7%"rowspan="2">Amount</th>';
            echo '<th style = "width: 5%"rowspan="2">Tax</th>';              
            echo '<th style = "width: 13%"rowspan="2">Payee</th>';
            echo '<th style = "width: 7%"rowspan="2">Paid</th>';
            echo '<th style = "width: 15%"rowspan="2">Invoice</th>';
        echo '</tr>';
        echo '<tr>';
            echo '<th style = "width: 7%">Price</th>';
            echo '<th style = "width: 7%">Unit(H)</th>';              
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

            $sql = "SELECT * FROM payment where studentL = '{$licence}' and payeeL = '{$userlicence}'  order by date";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                if(mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo "<tr>";
                        echo "<th style = 'width: 10%'>",$row['date'],"</th>";     
                        echo "<th style = 'width: 6%'>",$row['invoiceN'],"</th>";
                        echo "<th style = 'width: 35%'>",$row['description'],"</th>";
                        echo "<th style = 'width: 7%'>",$row['unitprice'],"</th>";
                        echo "<th style = 'width: 7%'>",$row['unit'],"</th>";
                        echo "<th style = 'width: 7%'>",$row['amount'],"</th>";
                        echo "<th style = 'width: 5%'>",$row['tax'],"</th>";                  
                        echo "<th style = 'width: 13%'>",$row['payeeName'],"</th>";
                        if($row['paid'] == 0)
                        {
                            echo "<th style = 'width: 7%'>N</th>";                    
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
        echo "</tbody>";
    echo "</table>";

?>