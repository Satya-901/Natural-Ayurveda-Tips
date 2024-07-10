<?php
include_once ('admin\db_connect.php');

// Function to sanitize input data
function sanitize_input($data)
{
    global $conn;
    $data = trim($data);
    $data = mysqli_real_escape_string($conn, $data);
    $data = strip_tags($data);
    return $data;
}
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



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = sanitize_input($_POST['fullname']);
    $mobile = sanitize_input($_POST['mobile']);
    $address = sanitize_input($_POST['address']);
    $email = sanitize_input($_POST['email']);
    $state = sanitize_input($_POST['state']);
    $city = sanitize_input($_POST['city']);
    $pincode = sanitize_input($_POST['pincode']);
    $payment_method = sanitize_input($_POST['payment_method']);
    $product_name = sanitize_input($_POST['product_name']);
    $product_price = sanitize_input($_POST['total_price']);

    if (!validate_mobile($mobile)) {
        $errors[] = "Invalid mobile number format.";
    }
    if (!validate_pincode($pincode)) {
        $errors[] = "Invalid pincode format.";
    }
    // Validate email address
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


    // Get product details from database based on your logic
    // $product_id = (int) $_GET['id'];
    // $qry = $conn->query("SELECT * FROM product_list WHERE id = $product_id")->fetch_array();
    // $product_name = $qry['name'];
    // $product_price = $qry['price'];

    // Insert order details into your database
    $insert_order_sql = "INSERT INTO `orders`(`name`, `address`, `state`, `city`, `pincode`, `mobile`, `email`, `product_name`, `product_price`, `payment_method`, `status`) VALUES ('$fullname','$address','$state','$city','$pincode','$mobile','$email','$product_name','$product_price','$payment_method','1')";

    if ($conn->query($insert_order_sql) === TRUE) {
        $order_id = $conn->insert_id;

        // Handle different payment methods
        if ($payment_method == "pay_online") {
            // Redirect to payment gateway or process online payment
            header("Location: payment_gateway.php?order_id=$order_id");
            exit();
        } elseif ($payment_method == "pay_on_delivery") {
            // Send email confirmation or display success message
            $message = "Thank you for your order. Your order ID is: $order_id.";
            // Example: Send email confirmation
            // mail($email, 'Order Confirmation', $message);

            // Display success message
            echo "<h2>Order Placed Successfully!</h2>";
            echo "<p>Your order ID is: $order_id.</p>";
            echo "<p>We will contact you shortly for confirmation.</p>";
        }
    } else {
        echo "Error: " . $insert_order_sql . "<br>" . $conn->error;
    }
} else {
    // Redirect to the checkout page if accessed directly without POST data
    header("Location: checkout.php");
    exit();
}

// Close database connection
$conn->close();
?>