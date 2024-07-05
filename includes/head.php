<?php session_start() ?>
<?php include ('admin/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Natural Ayurveda Tips: Timeless Wisdom for Holistic Health</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/font.css">
    <link rel="stylesheet" href="assets/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" id="theme-change" type="text/css" href="#">
    <link rel="shortcut icon" href="assets/img/logo.png" type="image/x-icon">


    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
    <script src="admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 100;
        }

        .my-float {
            margin-top: 15px;
            height: 30px;
        }
    </style>
</head>

<body>
    <!-- pre loader start -->
    <div class="pa-preloader">
        <div class="pa-ellipsis">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <!-- pre loader end -->
    <!-- main wrapper start -->
    <div class="pa-main-wrapper"></div>