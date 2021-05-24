<?php

require_once 'config.php';

function saveQuotation1(array $data) {
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
            throw new Exception("Please add atleast one product to quotation.");

        // escape variables for security
        if (!empty($data)) {
            $customer_id = mysqli_real_escape_string($con, trim($data['customer_id']));
            $quotationDate = mysqli_real_escape_string($con, trim($data['quotationDate']));
            $from_date = mysqli_real_escape_string($con, trim($data['from_date']));
            $expire_date = mysqli_real_escape_string($con, trim($data['expire_date']));
            $customer_name = mysqli_real_escape_string($con, trim($data['customer_name']));
            $phone = mysqli_real_escape_string($con, trim($data['phone']));
            $address = mysqli_real_escape_string($con, trim($data['address']));
            $total_amount = mysqli_real_escape_string($con, trim($data['quotation_total']));
            $gross_amount = mysqli_real_escape_string($con, trim($data['quotation_subtotal']));
            $discount = mysqli_real_escape_string($con, trim($data['discount']));
            $tax = mysqli_real_escape_string($con, trim($data['tax']));
            $additional_tax = mysqli_real_escape_string($con, trim($data['additonaltax']));
            $notes = mysqli_real_escape_string($con, trim($data['notes']));

            $quotation_id = mysqli_real_escape_string($con, trim($data['quotation_id']));

            if (!empty($quotation_id)) {
                $query = "UPDATE quotation SET customer_id='$customer_id',date=STR_TO_DATE('$quotationDate', '%m/%d/%Y'),from_date=STR_TO_DATE('$from_date', '%m/%d/%Y'),expire_date=STR_TO_DATE('$expire_date', '%m/%d/%Y'),customer_name='$customer_name',
							number='$phone',address='$address',total_amount='$total_amount',
							gross_amount='$gross_amount',discount='$discount',tax='$tax',
							additional_tax='$additional_tax',notes='$notes' WHERE quotation_id='$quotation_id'";
            }
            if (!mysqli_query($con, $query)) {
                throw new Exception(mysqli_error($con));
            } else {
                if (empty($quotation_id))
                    $quotation_id = mysqli_insert_id($con);
            }

            if (isset($data['data']) && !empty($data['data'])) {
                saveQuotationDetail1($data['data'], $quotation_id);
            }

            return [
                'success' => true,
                'message' => 'quotation Saved Successfully.'
            ];
        } else {
            throw new Exception("Please check, some of the required fileds missing");
        }
    } else {
        throw new Exception("Please check, some of the required fileds missing");
    }
}

function saveQuotationDetail1(array $quotation_details, $quotation_id = '$quotation_id') {
    global $con;

    $query = "DELETE FROM quotation_details WHERE quotation_id='$quotation_id'";
    mysqli_query($con, $query);

    foreach ($quotation_details as $quotation_detail) {
        $product_code = mysqli_real_escape_string($con, trim($quotation_detail['product_id']));
        $price = mysqli_real_escape_string($con, trim($quotation_detail['price']));
        $quantity = mysqli_real_escape_string($con, trim($quotation_detail['quantity']));
        $total = mysqli_real_escape_string($con, trim($quotation_detail['total']));


        $query = "INSERT INTO quotation_details (`quotation_detail_id`, `quotation_id`, `product_code`, `price`, `quantity`, `total`)
                VALUES (NULL, '$quotation_id', '$product_code', '$price', '$quantity', '$total')";
        mysqli_query($con, $query);
    }
}

function getCotetions1() {
    global $con;
    $data = [];
    $query = "select quotation.`quotation_id`,customer.`customer_name`,quotation.`total_amount` from quotation LEFT JOIN customer on quotation.customer_id=customer.customer_id";
    if ($result = mysqli_query($con, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($data, $row);
        }
    }
    return $data;
}

?>