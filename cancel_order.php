<?php
session_start();
include 'admin/db_connect.php';

if (!isset($_GET['order_id'])) {
    echo "Invalid request.";
    exit();
}

$order_id = intval($_GET['order_id']);
$user_id = isset($_SESSION['login_user_id']) ? $_SESSION['login_user_id'] : 0;

// Check if the order belongs to the user or if the request is from the admin
if ($user_id || isset($_SESSION['admin_login'])) {
    $where_clause = isset($_SESSION['admin_login']) ? "" : "AND user_id = '$user_id'";

    // Update the order to set the cancelled status
    $sql = "UPDATE `orders` SET `cancelled` = 1 WHERE `id` = $order_id $where_clause";
    if ($conn->query($sql) === TRUE) {
        echo "Order cancelled successfully.";
    } else {
        echo "Error cancelling order: " . $conn->error;
    }
} else {
    echo "Unauthorized request.<br> Phone: +91 9718832501
Email: Contact@naturalayurvedatips.com
connect admin to cancel";
}

$conn->close();
?>