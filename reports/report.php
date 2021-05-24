<?php
include 'connection.php';
?>
<html>
    <head>
        
    </head>
    <body>
        <img style="padding-left:  450px;"/>
        <hr>
        <form method="post">
        Date : <select name="date">
            <option>Select Date</option>
            <?php
           
           $customer=mysqli_query($conn,"SELECT * FROM invoice");
           while ($customerdata = mysqli_fetch_array($customer))
           {
               $date=$customerdata['date'];
               $date1=date('M' , strtotime($date));
               echo "<option value='{$customerdata['date']}'>$date</option>";
           }
                
            
            ?>  
        </select>
        <input type="submit" value="Filter">
        </form>
        <br>
 <?php
 if($_POST)
 {
   
     echo"<table border='1'>";
 
          $date1=$_POST['date'];
          echo"<tr>";
            echo "<th>Date</th>";
            echo "<th>Month</th>";
            echo "<th>Product Code</th>";
            echo "<th>Price</th>";    
            echo "<th>Quantity</th>"; 
            echo "<th>Total</th>";
            echo"</tr>";
        $customerquery=mysqli_query($conn,"SELECT invoice_details.invoice_id,MONTHNAME(invoice.date) AS date, COUNT(product.product_code) AS product_code,SUM(invoice_details.price) AS price, SUM(invoice_details.quantity) AS quantity,SUM(invoice_details.total) AS total FROM invoice_details INNER JOIN invoice ON invoice_details.invoice_id=invoice.invoice_id INNER JOIN product ON invoice_details.product_code=product.product_code GROUP BY MONTHNAME(invoice.date) DESC ") or die(mysql_error());
        while($customerdetail=  mysqli_fetch_array($customerquery))
        {
            echo "<td>{$customerdetail['invoice_id']}</td>";
            echo "<td>{$customerdetail['date']}</td>";
            echo "<td>{$customerdetail['product_code']}</td>";
            echo "<td>{$customerdetail['price']}</td>";
            echo "<td>{$customerdetail['quantity']}</td>";
            echo "<td>{$customerdetail['total']}</td>";

            
                        echo"<tr>";

            echo"</tr>";
            
            
          
        }
        echo "</table>";
 }     
        ?>
          
        
    </body>    
    
</html>

