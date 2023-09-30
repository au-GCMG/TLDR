<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="author" content="Shansong Huang" />
    <meta name="description" content="Invoice" />
    <link rel = "stylesheet", type="text/css", href="styles/invoice.css">
    <title>Invoice</title>
  </head>
  <?php

  ?>
  <body>
    <div id = "invoiceTitle">
        <div id = "invoiceName">    
            <h4>TLDR Instructor</h4>
            <h4>Invoice</h4>
        </div>
        <div id = "invoiceInfo">
            <a>Invoice NO.</a><a>invoiceN</a><br>
            <a>Date:</a><a>dated</a>        
        </div>
    </div>    
    <div id = "invoiceHead">
        <div id = "student">
            <a>TO:</a><br>
            <a>Student: </a><a>firstname surname</a><br>
            <a>address</a><br>
            <a>suburb</a><a>post</a><br>
            <a>state</a>
        </div>
        
        <div id = "instructor">
            <a>Instructor: </a><a>firstname surname</a><br>
            <a>address</a><br>
            <a>suburb</a><a>post</a><br>
            <a>state</a>
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
        <a >SubTotal: </a><a>45.00</a><br>
        <a >Tax: </a><a>4.50</a><br>
        <a >Total: </a><a>49.50</a>
    </div>
  </body>
</html>