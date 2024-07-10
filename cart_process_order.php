<?php
session_start();
include 'admin/db_connect.php';

function validate_mobile($mobile)
{
    return preg_match('/^[0-9]{10}$/', $mobile);
}

function validate_pincode($pincode)
{
    return preg_match('/^[1-9][0-9]{5}$/', $pincode);
}

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function sanitize_input($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = $conn->real_escape_string($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = sanitize_input($_POST['fullname']);
    $mobile = sanitize_input($_POST['mobile']);
    $email = sanitize_input($_POST['email']);
    $address = sanitize_input($_POST['address']);
    $state = sanitize_input($_POST['state']);
    $city = sanitize_input($_POST['city']);
    $pincode = sanitize_input($_POST['pincode']);
    $payment_method = sanitize_input($_POST['payment_method']);
    $total_price = sanitize_input($_POST['total_price']);
    $product_names = $_POST['product_name'];
    $product_prices = $_POST['product_price'];

    if (!validate_mobile($mobile)) {
        $errors[] = "Invalid mobile number format.";
    }
    if (!validate_pincode($pincode)) {
        $errors[] = "Invalid pincode format.";
    }
    if (!validate_email($email)) {
        $errors[] = "Invalid email address.";
    }

    // If there are validation errors, display them and redirect back to the checkout page
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
        echo "<p>Please go back and correct the errors.</p>";
        echo '<p><a href="checkout.php">Go back to checkout page</a></p>';
        exit();
    }

    // Insert order details into the orders table
    $sql = "INSERT INTO `orders`(`name`, `address`, `state`, `city`, `pincode`, `mobile`, `email`, `product_price`, `payment_method`, `status`) VALUES ('$fullname','$address','$state','$city','$pincode','$mobile','$email','$total_price','$payment_method','1')";

    if ($conn->query($sql) === TRUE) {
        $order_id = $conn->insert_id; // Get the last inserted ID

        // Insert each product into the order_items table
        foreach ($product_names as $index => $product_name) {
            $product_name = sanitize_input($product_name);
            $product_price = sanitize_input($product_prices[$index]);
            $sql_item = "INSERT INTO order_items (order_id, product_name, product_price) VALUES ('$order_id', '$product_name', '$product_price')";
            $conn->query($sql_item);
        }

        // Clear the cart after placing the order
        if (isset($_SESSION['login_user_id'])) {
            $conn->query("DELETE FROM cart WHERE user_id = '" . $_SESSION['login_user_id'] . "'");
        } else {
            $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
            $conn->query("DELETE FROM cart WHERE client_ip = '" . $ip . "'");
        }

        // Display the order details
        $order_details = "";
        foreach ($product_names as $index => $product_name) {
            $product_price = number_format($product_prices[$index], 2);
            $order_details .= "Product: $product_name, Price: ₹ $product_price/-<br>";
        }

        if ($payment_method == "pay_online") {
            // Redirect to payment gateway or process online payment
            header("Location: payment_gateway.php?order_id=$order_id");
            exit();
        } elseif ($payment_method == "pay_on_delivery") {
            $subject = "Order Confirmation";
            $message = "
            <html>
            <head>
                <title>Order Confirmation</title>
            </head>
            <body>
                <h2>Thank you for your order!</h2>
                <p>Order ID: $order_id</p>
                <p>Total Price: ₹ " . number_format($total_price, 2) . "/-</p>
                <p>$order_details</p>
                <p>Your order will be delivered to:</p>
                <p>$fullname</p>
                <p>$address, $city, $state, $pincode</p>
            </body>
            </html>
            ";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: no-reply@yourwebsite.com" . "\r\n";

            mail($email, $subject, $message, $headers);

            header("Location: thankyou.php?order_id=$order_id&name=$fullname&product={$product_names[0]}&price=" . number_format($product_prices[0], 2));
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>