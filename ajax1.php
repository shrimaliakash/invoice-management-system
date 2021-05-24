<html>
    <head>
        <!-- select multiple autocomplete text --> 
        <link rel="stylesheet" href="css/select2.min.css">
        <!-- /select multiple autocomplete text --> 
    </head>
    <body>

        <?php
        require_once 'connection.php';
        $query1 = mysqli_query($conn, "SELECT * FROM customer");
        $rowCount1 = mysqli_num_rows($query1);
        if (isset($_POST['customer_id'])) {

            $query = "SELECT customer_name,phone,address FROM customer WHERE customer_id=" . $_POST['customer_id'] . "";
            $result = mysqli_query($conn, $query);
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {

                echo '<div class="form-group">';
                echo '<input type="text" data-type="customerName" name="customer_name" id="customer_name" class="form-control autocomplete_txt1" autocomplete="on" value="' . $row['customer_name'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<input type="text" data-type="customerNo" name="phone" id="phone" class="form-control autocomplete_txt1" autocomplete="on" value="' . $row['phone'] . '">';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<textarea class="form-control autocomplete_txt1" rows="3" data-type="customerAddress" name="address" id="address" placeholder="customer Address" autocomplete="on"  ondrop="return false;" onpaste="return false;">' . $row['address'] . '</textarea>';
                echo '</div>';
            }
        }
        ?>

        <!-- multiple autocomplete -->       
        <!-- Bootstrap 3.3.6 -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="js/select2.full.min.js"></script>
        <!-- Page script -->
        <script>
            $(function () {
                //Initialize Select2 Elements
                $(".select2").select2();
            });
        </script>
        <!--/ multiple autocomplete -->
    </body>
</html>		