<?php
include_once ('includes/head.php');
include_once ('includes/header.php');
// Check if the cart is empty
if (isset($_SESSION['login_user_id'])) {
    $user_id = $_SESSION['login_user_id'];
    $cart_query = "SELECT COUNT(*) as count FROM cart WHERE user_id = '$user_id'";
} else {
    $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
    $cart_query = "SELECT COUNT(*) as count FROM cart WHERE client_ip = '$ip'";
}

$cart_result = $conn->query($cart_query);
$cart_data = $cart_result->fetch_assoc();

if ($cart_data['count'] == 0) {
    echo "<script>
    alert('Your cart is empty. Please add items to your cart before proceeding to checkout.');
    window.location.href = 'products.php';
        </script>";
    exit();
}
?>
<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1>Checkout</h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>checkout</li>
            </ul>
        </div>
    </div>
</div>

<div class="pa-checkout spacer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="pa-bill-form">
                    <form method="post" action="cart_process_order.php">
                        <label class="pa-bill-title">
                            Billing details
                        </label>
                        <label>
                            <span>Full Name</span>
                            <input required type="text" name="fullname">
                        </label>
                        <label>
                            <span>Mobile</span>
                            <input required type="number" name="mobile">
                        </label>
                        <label>
                            <span>Email</span>
                            <input required type="email" name="email">
                        </label>
                        <label>
                            <span>Address</span>
                            <input required type="text" name="address">
                        </label>
                        <label>
                            <span>State</span>
                            <input name="state" required type="text">
                        </label>
                        <label>
                            <span>City</span>
                            <input name="city" required type="text">
                        </label>
                        <label>
                            <span>Pin code</span>
                            <input name="pincode" required type="number">
                        </label>
                        <label for="payment">
                            <span>Payment Method</span>
                            <input type="radio" name="payment_method" value="pay_online"><span>Pay Online</span>
                            <input type="radio" name="payment_method" value="pay_on_delivery"><span>Pay on
                                Delivery</span>
                        </label>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pa-bill-detail">
                    <p class="pa-bill-title">Order details</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Product name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['login_user_id'])) {
                                $data = "where c.user_id = '" . $_SESSION['login_user_id'] . "' ";
                            } else {
                                $ip = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : (isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']);
                                $data = "where c.client_ip = '" . $ip . "' ";
                            }
                            $total = 0;
                            $get = $conn->query("SELECT *,c.id as cid FROM cart c inner join product_list p on p.id = c.product_id " . $data);
                            while ($row = $get->fetch_assoc()):
                                $total += ($row['qty'] * $row['price']);
                                ?>
                                <tr>
                                    <td><?php echo $row['name'] ?></td>
                                    <td style="font-family: maths;">₹ <?php echo number_format($row['price'], 2) ?>/-</td>
                                    <input type="hidden" name="product_name[]" value="<?= $row['name']; ?>">
                                    <input type="hidden" name="product_price[]" value="<?= $row['price']; ?>">
                                </tr>
                            <?php endwhile; ?>
                            <tr class="pa-checkout-total">
                                <td>Grand Total</td>
                                <td style="font-family: maths;">
                                    ₹ <?php echo number_format($total, 2) ?>/-
                                    <input name="total_price" type="hidden" value="<?= $total ?>">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="pa-place-order-btn">
                        <button type="submit" class="pa-btn">Place Order</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.php'); ?>