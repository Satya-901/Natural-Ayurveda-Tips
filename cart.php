<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>

<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1>Cart</h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>cart</li>
            </ul>
        </div>
    </div>
</div>

<div class="pa-cart spacer-top spacer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="pa-cart-box">
                    <table>
                        <thead>
                            <tr>
                                <th>Product image</th>
                                <th>Product name</th>
                                <th>unit price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Delete</th>
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
                                    <td>
                                        <div class="pa-cart-img">
                                            <center><img src="assets/img/<?php echo $row['img_path'] ?>" alt="image"
                                                    class="img-fluid"></center>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['name'] ?>
                                    </td>
                                    <td><?php echo number_format($row['price'], 2) ?></td>
                                    <td>
                                        <div class="pa-cart-quantity">
                                            <div>
                                                <button class="pa-sub qty-minus" type="button"
                                                    data-id="<?php echo $row['cid'] ?>"></button>
                                            </div>
                                            <input type="number" readonly value="<?php echo $row['qty'] ?>" min=1
                                                name="qty">
                                            <div>
                                                <button class="pa-add qty-plus" type="button" id=""
                                                    data-id="<?php echo $row['cid'] ?>"></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>₹ <?php echo number_format($row['qty'] * $row['price'], 2) ?></td>
                                    <td><a href="admin/ajax.php?action=delete_cart&id=<?php echo $row['cid'] ?>"
                                            class="rem_cart btn btn-sm btn-outline-danger"
                                            data-id="<?php echo $row['cid'] ?>"><i class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                    <div class="pa-garnd-total">
                        <p>
                            <span>Grant total:</span>
                            <span>₹ <?php echo number_format($total, 2) ?></span>
                        </p>
                        <?php
                        if (isset($_SESSION['login_user_id']) == 1) {
                            echo '<a href="checkout.php" class="pa-btn">Proceed to checkout</a>';
                        } else {
                            echo '<button type="button" class="pa-btn" data-bs-toggle="modal" data-bs-target="#signupModal">Proceed to checkout</button>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $('.view_prod').click(function () {
        uni_modal_right('Product', 'view_prod.php?id=' + $(this).attr('data-id'))
    })
    $('.qty-minus').click(function () {
        var qty = $(this).parent().siblings('input[name="qty"]').val();
        update_qty(parseInt(qty) - 1, $(this).attr('data-id'))
        if (qty == 1) {
            return false;
        } else {
            $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) - 1);
        }
    })
    $('.qty-plus').click(function () {
        var qty = $(this).parent().siblings('input[name="qty"]').val();
        $(this).parent().siblings('input[name="qty"]').val(parseInt(qty) + 1);
        update_qty(parseInt(qty) + 1, $(this).attr('data-id'))
    })
    function update_qty(qty, id) {
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=update_cart_qty',
            method: "POST",
            data: { id: id, qty },
            success: function (resp) {
                if (resp == 1) {
                    load_cart()
                    end_load()
                }
            }
        })

    }
    $('#checkout').click(function () {
        if ('<?php echo isset($_SESSION['login_user_id']) ?>' == 1) {
            location.replace("index.php?page=checkout")
        } else {
            uni_modal("Checkout", "signup.php?page=checkout")
        }
    })
</script>
<?php include_once ('includes/footer.php'); ?>