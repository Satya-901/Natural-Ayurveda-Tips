<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>
<?php
$qry = $conn->query("SELECT * FROM  product_list where id = " . $_GET['id'])->fetch_array();
?>
<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1><?php echo $qry['name'] ?></h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>products</li>
            </ul>
        </div>
    </div>
</div>


<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6">
            <center><img style="height: 400px;" src="assets/img/<?= $qry['img_path'] ?>" alt=""></center>
        </div>
        <div class="col-md-6">
            <h2><?php echo $qry['name'] ?></h2>
            <p class="text-muted">Category: <?php echo $qry['category_id'] ?></p>
            <p class="lead">₹ <?= $qry['price']; ?>/-</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam convallis rutrum magna eget bibendum.
                Nulla varius interdum metus ut lobortis.</p>
            <hr>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <div class="input-group col-md-7 mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button" id="qty-minus"><span
                                class="fa fa-minus"></button>
                    </div>
                    <input type="number" readonly value="1" min=1 class="form-control text-center" name="qty">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-dark" type="button" id="qty-plus"><span
                                class="fa fa-plus"></span></button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" id="add_to_cart_modal"><i class="fa fa-cart-plus"></i> Add to Cart</button>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col">
            <?= $qry['description']; ?>
        </div>
    </div>

</div>

<script>
    $('#qty-minus').click(function () {
        var qty = $('input[name="qty"]').val();
        if (qty == 1) {
            return false;
        } else {
            $('input[name="qty"]').val(parseInt(qty) - 1);
        }
    })
    $('#qty-plus').click(function () {
        var qty = $('input[name="qty"]').val();
        $('input[name="qty"]').val(parseInt(qty) + 1);
    })
    $('#add_to_cart_modal').click(function () {
        start_load()
        $.ajax({
            url: 'admin/ajax.php?action=add_to_cart',
            method: 'POST',
            data: { pid: '<?php echo $_GET['id'] ?>', qty: $('[name="qty"]').val() },
            success: function (resp) {
                if (resp == 1)
                    toastMixin.fire({
                        animation: true,
                        position: 'bottom',
                        title: 'product addesd to the cart'
                    });
                $('.item_count').html(parseInt($('.item_count').html()) + parseInt($('[name="qty"]').val()))
                $('.modal').modal('hide')
                end_load()
            }
        })
    })
</script>


<?php include_once ('includes/footer.php'); ?>