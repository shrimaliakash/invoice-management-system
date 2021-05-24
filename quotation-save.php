<?php

require_once 'config.php';

function saveQuotation(array $data) {
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
            $from_date = mysqli_real_escape_string($con, date("Y-m-d", strtotime($data['from_date'])));
            $expire_date = mysqli_real_escape_string($con, date("Y-m-d", strtotime($data['expire_date'])));
            $customer_name = mysqli_real_escape_string($con, trim($data['customer_name']));
            $phone = mysqli_real_escape_string($con, trim($data['phone']));
            $address = mysqli_real_escape_string($con, trim($data['address']));
            $total_amount = mysqli_real_escape_string($con, trim($data['quotation_total']));
            $gross_amount = mysqli_real_escape_string($con, trim($data['quotation_subtotal']));
            if(!empty($data['discount'])) {
                $discount = mysqli_real_escape_string($con, trim($data['discount']));
            } else {
                $discount = 0;
            }
            if(!empty($data['tax'])) {
                $tax = mysqli_real_escape_string($con, trim($data['tax']));
            } else {
                $tax = 0;
            }
            if(!empty($data['additional_tax'])) {
                $additional_tax = mysqli_real_escape_string($con, trim($data['additional_tax']));
            } else {
                $additional_tax = 0;
            }
            $notes = mysqli_real_escape_string($con, trim($data['notes']));

            $quotation_id = mysqli_real_escape_string($con, isset($data['quoatation_id']) ? trim($data['quotation_id']) : '');

            if (empty($quotation_id)) {
                $query = "INSERT INTO quotation (`quotation_id`, `customer_id`, `date`, `from_date`, `expire_date`, `customer_name`, `number`, `address`, `total_amount`, `gross_amount`, `discount`,`tax`,
							`additional_tax`,`notes`)
							VALUES (NULL, '$customer_id', '$quotationDate', '$from_date', '$expire_date', '$customer_name', '$phone', '$address', '$total_amount', '$gross_amount','$discount', '$tax', '$additional_tax','$notes')";
            } else {
                $query = "DELETE FROM quotation_details WHERE quotation_id='$quotation_id'";
                $query = "UPDATE quotation SET customer_id='$customer_id',date='$quotationDate',from_date='$from_date',expire_date='$expire_date',customer_name='$customer_name',
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
                saveQuotationDetail($data['data'], $quotation_id);
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

function saveQuotationDetail(array $quotation_details, $quotation_id = '') {
    global $con;

    foreach ($quotation_details as $quotation_detail) {
        $product_code = mysqli_real_escape_string($con, trim($quotation_detail['product_id']));
        $price = mysqli_real_escape_string($con, trim($quotation_detail['price']));
        $quantity = mysqli_real_escape_string($con, trim($quotation_detail['quantity']));
        $total = mysqli_real_escape_string($con, trim($quotation_detail['total']));


        echo $query = "INSERT INTO quotation_details (`quotation_detail_id`, `quotation_id`, `product_code`, `price`, `quantity`, `total`)
                VALUES (NULL, '$quotation_id', '$product_code', '$price', '$quantity', '$total')";
        mysqli_query($con, $query);
    }
}

function getCotetions() {
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