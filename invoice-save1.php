<?php

require_once 'config.php';

function saveInvoice1(array $data) {
    if (!empty($data)) {
        global $con;

        $count = 0;
        if (isset($data['data'])) {
            foreach ($data['data'] as $value) {
                if (!empty($value['product_id']))
                    $count++;
            }
        }

        if ($count == 0)
            throw new Exception("Please add atleast one product to invoice.");

        // escape variables for security
        if (!empty($data)) {
            $customer_id = mysqli_real_escape_string($con, trim($data['customer_id']));
            $invoiceDate = mysqli_real_escape_string($con, trim($data['invoiceDate']));
            $from_date = mysqli_real_escape_string($con, trim($data['from_date']));
            $expire_date = mysqli_real_escape_string($con, trim($data['expire_date']));
            $customer_name = mysqli_real_escape_string($con, trim($data['customer_name']));
            $phone = mysqli_real_escape_string($con, trim($data['phone']));
            $address = mysqli_real_escape_string($con, trim($data['address']));
            $total_amount = mysqli_real_escape_string($con, trim($data['invoice_total']));
            $gross_amount = mysqli_real_escape_string($con, trim($data['invoice_subtotal']));
            $discount = mysqli_real_escape_string($con, trim($data['discount']));
            $tax = mysqli_real_escape_string($con, trim($data['tax']));
            $additional_tax = mysqli_real_escape_string($con, trim($data['additonaltax']));
            $notes = mysqli_real_escape_string($con, trim($data['notes']));

            $invoice_id = mysqli_real_escape_string($con, trim($data['invoice_id']));

            if (!empty($invoice_id)) {
                $query = "UPDATE invoice SET customer_id='$customer_id',date=STR_TO_DATE('$invoiceDate', '%m/%d/%Y'),
                          from_date=STR_TO_DATE('$from_date', '%m/%d/%Y'),expire_date=STR_TO_DATE('$expire_date', '%m/%d/%Y'),
                          customer_name='$customer_name',number='$phone',address='$address',total_amount='$total_amount',gross_amount='$gross_amount',
                          discount='$discount',tax='$tax',additional_tax='$additional_tax',notes='$notes' WHERE invoice_id='$invoice_id'";
            }
            if (!mysqli_query($con, $query)) {
                throw new Exception(mysqli_error($con));
            } else {
                if (empty($invoice_id))
                    $invoice_id = mysqli_insert_id($con);
            }

            if (isset($data['data']) && !empty($data['data'])) {
                saveInvoiceDetail1($data['data'], $invoice_id);
            }
            return [
                'success' => true,
                'message' => 'Invoice Saved Successfully.'
            ];
        } else {
            throw new Exception("Please check, some of the required fileds missing");
        }
    } else {
        throw new Exception("Please check, some of the required fileds missing");
    }
}

function saveInvoiceDetail1(array $invoice_details, $invoice_id = '') {
    global $con;

    $query = "DELETE FROM invoice_details WHERE invoice_id='$invoice_id'";
    mysqli_query($con, $query);

    foreach ($invoice_details as $invoice_detail) {
        $product_code = mysqli_real_escape_string($con, trim($invoice_detail['product_id']));
        $price = mysqli_real_escape_string($con, trim($invoice_detail['price']));
        $quantity = mysqli_real_escape_string($con, trim($invoice_detail['quantity']));
        $total = mysqli_real_escape_string($con, trim($invoice_detail['total']));


        $query = "INSERT INTO invoice_details (`invoice_detail_id`, `invoice_id`, `product_code`, `price`, `quantity`, `total`)
                VALUES (NULL, '$invoice_id', '$product_code', '$price', '$quantity', '$total')";
        mysqli_query($con, $query);
    }
}

function getInvoices1() {
    global $con;
    $data = [];
    $query = "select invoice.`invoice_id`,customer.`customer_name`,invoice.`total_amount` from invoice LEFT JOIN customer on invoice.customer_id=customer.customer_id";
    if ($result = mysqli_query($con, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
    }
    return $data;
}

?>