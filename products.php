<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>

<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1>Shop</h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>Shop</li>
            </ul>
        </div>
    </div>
</div>

<div class="spacer-top spacer-bottom">
    <div class="container">
        <div class="pa-heading">
            <h1 class="text-dark">products</h1>
        </div>
        <div class="row justify-content-center">
            <?php
            $limit = 10;
            $page = (isset($_GET['_page']) && $_GET['_page'] > 0) ? $_GET['_page'] - 1 : 0;
            $offset = $page > 0 ? $page * $limit : 0;
            $all_menu = $conn->query("SELECT id FROM  product_list")->num_rows;
            $page_btn_count = ceil($all_menu / $limit);
            $qry = $conn->query("SELECT * FROM  product_list order by `name` asc Limit $limit OFFSET $offset ");
            while ($row = $qry->fetch_assoc()):
                ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="pa-product-box">
                        <div style="height: 150px;" class="pa-product-img">
                            <img style="height: 200px;" src="assets/img/<?php echo $row['img_path'] ?>"
                                alt="assets/img/<?php echo $row['img_path'] ?>" class="img-fluid" />
                        </div>
                        <div class="pa-product-content">
                            <h4><a href="product-detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                            </h4>
                            <p>&#8377; <?php echo $row['price'] ?></p><br>

                            <a style="    color: #fff; background-color: #684427; border-color: #684427;" class="btn btn-sm"
                                href="product-detail.php?id=<?php echo $row['id'] ?>">Shop Now</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.php'); ?>