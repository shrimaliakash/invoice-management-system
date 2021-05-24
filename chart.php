<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Pie Chart Demo (Google VAPI) - http://codeofaninja.com/</title>
    </head>
    
<body style="font-family: Arial;border: 0 none;">
    <!-- where the chart will be rendered -->
    <div id="visualization" style="width: 600px; height: 400px;"></div>
 
    <?php
 
    //include database connection
    include 'connection.php';
 
    //query all records from the database
    $query = "SELECT product.product_name,COUNT(invoice_details.`product_code`) AS TotalProduct,
                                                            SUM(invoice_details.`price`) AS Prices,invoice_details.`quantity` AS Quantities,
                                                            (SUM(invoice_details.price) * invoice_details.quantity) AS Totals FROM product
                                                            LEFT JOIN invoice_details ON product.product_code=invoice_details.product_code
                                                            GROUP BY product.product_name HAVING TotalProduct != 0";
 
    //execute the query
    $result = mysqli_query($conn,$query );
 
    //get number of rows returned
    $num_results = $result->num_rows;
 
    if( $num_results > 0){
 
    ?>
        <!-- load api -->
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>
        
        <script type="text/javascript">
            //load package
            google.load('visualization', '1', {packages: ['corechart']});
        </script>
 
        <script type="text/javascript">
            function drawVisualization() {
                // Create and populate the data table.
                var data = google.visualization.arrayToDataTable([
                    ['PL', 'Ratings'],
                    <?php
                    while( $row = $result->fetch_assoc() ){
                        extract($row);
                        echo "['{$name}', {$ratings}],";
                    }
                    ?>
                ]);
 
                // Create and draw the visualization.
                new google.visualization.PieChart(document.getElementById('visualization')).
                draw(data, {title:"Tiobe Top Programming Languages for June 2012"});
            }
 
            google.setOnLoadCallback(drawVisualization);
        </script>
    <?php
 
    }else{
        echo "No programming languages found in the database.";
    }
    ?>
    
</body>
</html>