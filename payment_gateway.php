<?php
// Include your database connection file or initialize your database connection
include_once ('admin\db_connect.php');

// PayPal API credentials and settings
$paypal_client_id = 'YOUR_PAYPAL_CLIENT_ID'; // Replace with your PayPal client ID
$paypal_secret = 'YOUR_PAYPAL_SECRET'; // Replace with your PayPal secret
$paypal_mode = 'sandbox'; // Change to 'live' for production

// PayPal API endpoints
$paypal_base_url = ($paypal_mode === 'sandbox') ? 'https://api.sandbox.paypal.com' : 'https://api.paypal.com';
$paypal_token_url = $paypal_base_url . '/v1/oauth2/token';
$paypal_payment_url = $paypal_base_url . '/v2/checkout/orders';

// PayPal API headers for authentication
$paypal_headers = array(
    'Accept: application/json',
    'Content-Type: application/x-www-form-urlencoded'
);

// Function to get PayPal access token
function get_paypal_access_token($client_id, $secret, $mode)
{
    global $paypal_token_url, $paypal_headers;

    $credentials = base64_encode($client_id . ':' . $secret);
    $data = 'grant_type=client_credentials';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $paypal_token_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $paypal_headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $credentials);

    $response = curl_exec($ch);
    curl_close($ch);

    $json_response = json_decode($response, true);
    return $json_response['access_token'];
}

// Validate order ID from query string
if (!isset($_GET['order_id']) || !is_numeric($_GET['order_id'])) {
    echo "Invalid order ID.";
    exit();
}

$order_id = (int) $_GET['order_id'];

// Retrieve order details from database
$order_query = $conn->query("SELECT * FROM orders WHERE id = $order_id");
if (!$order_query || $order_query->num_rows == 0) {
    echo "Order not found.";
    exit();
}

$order = $order_query->fetch_assoc();
$amount = $order['product_price']; // Example: Get amount from order details

// Get PayPal access token
$access_token = get_paypal_access_token($paypal_client_id, $paypal_secret, $paypal_mode);

// Create PayPal payment
$payment_data = array(
    'intent' => 'CAPTURE',
    'purchase_units' => array(
        array(
            'amount' => array(
                'currency_code' => 'USD', // Adjust currency code as per your requirements
                'value' => $amount // Example: $amount
            )
        )
    )
);

$payment_json = json_encode($payment_data);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $paypal_payment_url);
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token
    )
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payment_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$response_json = json_decode($response, true);

if (isset($response_json['id'])) {
    // Payment created successfully, update database status to 'paid'
    $update_sql = "UPDATE orders SET status = 1 WHERE id = $order_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "<h2>Payment Successful!</h2>";
        echo "<p>Your order ID: $order_id has been paid.</p>";
        // Additional actions after successful payment (send email, update inventory, etc.)
    } else {
        echo "Error updating order status: " . $conn->error;
    }
} else {
    // Error creating PayPal payment
    echo "Error creating PayPal payment: " . $response;
}

// Close database connection
$conn->close();
?>