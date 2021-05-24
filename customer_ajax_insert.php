<?php

include('connection.php');
if ($_POST['customer_name'] != "" && $_POST['phone'] != "" && $_POST['email'] != "" && $_POST['contact_no'] != "" && $_POST['address'] != "" && $_POST['contact_person'] != "" && $_POST['city'] != "" && $_POST['status'] != ""):
    extract($_POST);
    $customer_name = mysqli_real_escape_string($conn, $customer_name);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $contact_no = mysqli_real_escape_string($conn, $contact_no);
    $address = mysqli_real_escape_string($conn, $address);
    $contact_person = mysqli_real_escape_string($conn, $contact_person);
    $city = mysqli_real_escape_string($conn, $city);
    $status = mysqli_real_escape_string($conn, $status);

    $query = mysqli_query($conn, "INSERT INTO customer(customer_name,phone,email,contact_no,address,contact_person,city,status)
        VALUES('$customer_name','$phone','$email','$contact_no','$address','$contact_person','$city','$status')");
    $id = mysqli_insert_id($conn);
    $id3 = $id++;


    if ($query)
        $id1 = mysqli_query($conn, "select count(customer_id) as customer_id from customer");
    $id2 = mysqli_fetch_array($id1);
    $val = $id2['customer_id'];
    echo '<tr><td>' . $id3 . '</td><td>' . $customer_name . '</td><td>' . $phone . '</td><td>' . $email . '</td><td>' . $contact_no . '</td>
                <td>' . $address . '</td><td>' . $contact_person . '</td><td>' . $city . '</td><td>' . $status . '</td>
                <td><a data-id=' . $id3 . ' href="#" class="btn btn-warning">Update</a></td>           
                <td><a data-id=' . $id3 . ' class="delete btn btn-danger" href="#">Delete</a></td></tr>';
endif;
?>

<script type="text/javascript">
            $(function () {
                $(".delete").click(function () {
                    var element = $(this);
                    var del_id = element.attr("data-id");
                    var info = 'customer_id=' + del_id;
                    if (confirm("Are you sure you want to delete this?"))
                    {
                        $.ajax({
                            type: "POST",
                            url: "customer_ajax_delete.php",
                            data: info,
                            success: function () {

                            }
                        });
                        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow")
                                .animate({opacity: "hide"}, "slow");
                    }
                    return false;
                });
            });
        </script>