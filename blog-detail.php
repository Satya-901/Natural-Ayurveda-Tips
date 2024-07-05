<?php include_once ('includes/head.php'); ?>
<?php include_once ('includes/header.php'); ?>
<?php
$qry = $conn->query("SELECT * FROM  blog where id = " . $_GET['id'])->fetch_array();
?>
<!-- breadcrumb start -->
<div class="pa-breadcrumb">
    <div class="container-fluid">
        <div class="pa-breadcrumb-box">
            <h1><?php echo $qry['title'] ?></h1>
            <ul>
                <li><a href="./">Home</a></li>
                <li>blog</li>
            </ul>
        </div>
    </div>
</div>

<div class="pa-blog-single spacer-top spacer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <center><img style="height: 300px;" src="assets/img/<?php echo $qry['image'] ?>" alt="image"
                        class="img-fluid"></center>
                <div class="pa-bs-content">
                    <?php echo $qry['text'] ?>
                </div>
                <!-- <div class="pa-blog-comnt">
                    <h2 class="pa-cmnt-title">Leave a reply</h2>
                    <ul>
                        <li>
                            <div class="pa-cmnt-box">
                                <div class="pa-cmnt-img">
                                    <img src="assets/images/user.jpg" alt="image" class="img-fluid">
                                </div>
                                <div class="pa-cmnt-content">
                                    <h3>Jonson Brock</h3>
                                    <p><span class="pa-cmnt-date">1 May, 2020</span><span
                                            class="pa-cmnt-time">06:35:44</span></p>
                                    <p>Aenean sit amet odio nisi.Vestibulum vel dolor et justo sollicitudin tincidunt.
                                        Mauris eleifend elit metus.</p>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <div class="pa-cmnt-box">
                                        <div class="pa-cmnt-img">
                                            <img src="assets/images/user.jpg" alt="image" class="img-fluid">
                                        </div>
                                        <div class="pa-cmnt-content">
                                            <h3>Jonson Brock</h3>
                                            <p><span class="pa-cmnt-date">1 May, 2020</span><span
                                                    class="pa-cmnt-time">06:35:44</span></p>
                                            <p>Aenean sit amet odio nisi.Vestibulum vel dolor et justo sollicitudin
                                                tincidunt. Mauris eleifend elit metus.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="pa-cmnt-box">
                                <div class="pa-cmnt-img">
                                    <img src="assets/images/user.jpg" alt="image" class="img-fluid">
                                </div>
                                <div class="pa-cmnt-content">
                                    <h3>Jonson Brock</h3>
                                    <p><span class="pa-cmnt-date">1 May, 2020</span><span
                                            class="pa-cmnt-time">06:35:44</span></p>
                                    <p>Aenean sit amet odio nisi.Vestibulum vel dolor et justo sollicitudin tincidunt.
                                        Mauris eleifend elit metus.</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="pa-cmnt-form">
                        <form>
                            <input type="text" placeholder="Enter your name">
                            <input type="text" placeholder="Enter your email">
                            <textarea placeholder="Message here"></textarea>
                            <button class="pa-btn" type="submit">submit</button>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<?php include_once ('includes/footer.php'); ?>