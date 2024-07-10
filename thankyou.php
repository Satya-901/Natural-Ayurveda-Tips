<?php
if (!isset($_GET['name']) || !isset($_GET['product']) || !isset($_GET['price'])) {
    header("Location: index.php");
    exit();
}

$name = htmlspecialchars($_GET['name']);
$product = htmlspecialchars($_GET['product']);
$price = htmlspecialchars($_GET['price']);
$order_id = htmlspecialchars($_GET['order_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .thank-you-container {
            background-color: #fff;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 10px;
        }

        .thank-you-container img {
            width: 100px;
            margin-bottom: 20px;
        }

        .thank-you-container h1 {
            color: #333;
        }

        .thank-you-container p {
            color: #555;
            line-height: 1.6;
        }

        .cancel-button {
            margin-right: 10px;
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff4d4d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .cancel-button:hover {
            background-color: #ff1a1a;
        }
    </style>
</head>

<body>
    <div class="thank-you-container">
        <img src="path/to/your/thankyou_image.png" alt="Thank You">
        <h1>Dear <?php echo $name; ?>,</h1>
        <p>I hope this message finds you well. I wanted to personally thank you for choosing our product, the
            <?php echo $product; ?>, priced at ₹ <?php echo $price; ?>/-.
        </p>
        <p>Your purchase means a lot to us, and we are thrilled that you've chosen to trust us with your needs.</p>
        <p>We are committed to providing you with the best experience possible, and your satisfaction is our top
            priority. Should you have any questions or feedback, please don't hesitate to reach out to us.</p>
        <p>Once again, thank you for your purchase and for being a valued customer. We look forward to serving you again
            in the future.</p>
        <p>
            <a class="cancel-button" href='cancel_order.php?order_id=<?php echo $_GET["order_id"]; ?>'>Cancel Order</a>
            <a class="cancel-button" href='./'>Home</a>
        </p>
    </div>
</body>

</html>