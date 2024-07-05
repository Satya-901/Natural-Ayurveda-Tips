<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>

<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1>Blog</h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>Blog</li>
            </ul>
        </div>
    </div>
</div>

<div class="pa-blog spacer-top spacer-bottom">
    <div class="container">
        <div class="pa-heading">
            <img src="assets/images/herbal.svg" alt="image" class="img-fluid" />
            <h1>latest news</h1>
            <h5>blog</h5>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM blog";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="pa-blog-box">
                            <img style="height: 273px;" src="assets/img/<?= $row["image"] ?>" alt="" class="img-fluid">
                            <div class="pa-blog-title">
                                <h2><a href="blog-detail.php?id=<?= $row["id"]; ?>"><?= $row["title"] ?></a></h2>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.php'); ?>