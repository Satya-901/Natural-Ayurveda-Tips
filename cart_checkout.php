<?php
include_once ('includes/head.php');
include_once ('includes/header.php');

// Check if 'id' is present in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo '<script type="text/javascript">
            alert("Please select a product to proceed to checkout.");
            window.location.href = "products.php"; // Redirect to your products page
            </script>';
    exit; // Ensure no further code is executed
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
                    <form method="post" action="process_order.php">
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
            <?php
            // Assuming $conn is your database connection
            $qry = $conn->query("SELECT * FROM product_list where id = " . $_GET['id'])->fetch_array();
            ?>
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
                            <tr>
                                <td><?php echo $qry['name'] ?></td>
                                <td style="font-family: maths;">₹ <?= $qry['price']; ?>/-</td>
                                <input type="hidden" name="product_name" value="<?= $qry['name']; ?>">
                                <input type="hidden" name="product_price" value="<?= $qry['price']; ?>">
                            </tr>
                            <tr class="pa-checkout-total">
                                <td>Grand Total</td>
                                <td style="font-family: maths;">₹ <?= $qry['price']; ?>/-</td>
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