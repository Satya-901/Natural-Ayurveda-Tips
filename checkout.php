<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>

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
<?php
echo $_SESSION['login_user_id'];
// echo $login_user_id = $_SESSION['login_user_id'];
// echo $sql = "SELECT * FROM cart where user_id = $login_user_id";
$chk = $conn->query("SELECT * FROM cart where user_id = {$_SESSION['login_user_id']} ")->num_rows;
if ($chk <= 0) {
    echo "<script>alert('You don\'t have an Item in your cart yet.'); location.replace('./')</script>";
}
?>
<div class="pa-checkout spacer-bottom">
    <div class="container">
        <form id="checkout-frm">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pa-bill-form">
                        <label class="pa-bill-title">
                            Billing details
                        </label>
                        <label>
                            <span>Full Name</span>
                            <input type="text" name="first_name" required="" value="<?php echo $_SESSION['login_first_name'] ?>">
                            <input type="text" name="last_name" required="" value="<?php echo $_SESSION['login_last_name'] ?>">
                        </label>
                        <label>
                            <span>Mobile</span>
                            <input type="text" name="mobile" required="" value="<?php echo $_SESSION['login_mobile'] ?>">
                        </label>
                        <label>
                            <span>Address</span>
                            <input type="text" name="address" id="address" value="<?php echo $_SESSION['login_address'] ?>" required>
                        </label>
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" required="" value="<?php echo $_SESSION['login_email'] ?>">
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
                                        <td> <?php echo $row['name'] ?></td>
                                        <td>₹ <?php echo number_format($row['price'], 2) ?></td>
                                    </tr>
                                <?php endwhile; ?>
                                <tr class="pa-checkout-total">
                                    <td>Grand Total</td>
                                    <td>₹ <?php echo number_format($total, 2) ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="pa-place-order-btn">
                            <button class="btn btn-block btn-outline-dark">Place Order</button>
                            <button class="pa-btn">place order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#checkout-frm').submit(function (e) {
            e.preventDefault()

            start_load()
            $.ajax({
                url: "admin/ajax.php?action=save_order",
                method: 'POST',
                data: $(this).serialize(),
                success: function (resp) {
                    if (resp == 1) {
                        toastMixin.fire({
                            animation: true,
                            position: 'bottom',
                            title: 'product addesd to the cart'
                        });
                        // alert_toast("Order successfully Placed.")
                        setTimeout(function () {
                            location.replace('index.php?page=home')
                        }, 1500)
                    }
                }
            })
        })
    })
</script>


<?php include_once ('includes/footer.php'); ?>