<?php
session_start();
include '../admin/db_connect.php';

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $payment_status = $_POST['payment_status'];

    $sql = "UPDATE orders SET status='$status', payment_status='$payment_status' WHERE id='$order_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Order updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating order: " . $conn->error;
    }

    header("Location: index.php?page=orders");
    exit();
}
?>