<?php
    include 'connection.php';
    session_start();

    // Ensure $user_id is properly initialized
    if (!isset($_SESSION['user_id'])) {
        header('location:login.php');
        exit; // Added exit after redirect
    }
    $user_id = $_SESSION['user_id'];

    /*-------------------order placed-------------------------*/
    if (isset($_POST['order_btn'])) { // Corrected 'order-btn' to 'order_btn' to match form name
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $method = mysqli_real_escape_string($conn, $_POST['method']);
        $address = mysqli_real_escape_string($conn, 'flat no.' . $_POST['flate'] . ',' . $_POST['street'] . ',' . $_POST['city'] . ',' . $_POST['country'] . ',' . $_POST['pin']);
        $placed_on = date('d-M-Y');
        $cart_total = 0;
        $cart_products = []; // Initialize correctly as an array

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

        if (mysqli_num_rows($cart_query) > 0) {
            while ($cart_item = mysqli_fetch_assoc($cart_query)) {
                $cart_products[] = $cart_item['name'] . '(' . $cart_item['quantity'] . ')';
                $sub_total = ($cart_item['price'] * $cart_item['quantity']);
                $cart_total += $sub_total;
            }
        }

        $total_products = implode(', ', $cart_products);

        // Insert the order into the database
        mysqli_query($conn, "INSERT INTO `orders`(`user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`) 
        VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Insert query failed');

        // Corrected DELETE query
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$user_id'") or die('Delete query failed');

        // Set a session message for success
        $_SESSION['order_message'] = 'Order placed successfully';
        
        // Redirect to checkout page with message
        header('location:checkout.php');
        exit; // Ensure no further code is executed after header redirection
    }
?>


<style type="text/css">
    <?php include 'main.css'?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <title>Deelight</title>
</head>
<body>
    <?php include 'header.php' ?>
    <div class="banner">
        <h1>Checkout</h1>
        
    </div>
    <div class="checkout-form">
        <h1 class="title">payment process</h1>
        <?php
    // Check if the success message is set in session
    if (isset($_SESSION['order_message'])) {
        echo '
            <div class="message">
                <span>' . htmlspecialchars($_SESSION['order_message']) . '</span>
                <i onclick="this.parentElement.style.display=\'none\'">&times;</i>
            </div>
        ';
        // Unset the message so it doesn't show again
        unset($_SESSION['order_message']);
    }
?>

        <div class="display-order">
            <?php
                $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'  ") ;
                $total=0;
                $grand_total=0;
                if(mysqli_num_rows($select_cart)>0){
                    while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                       $total_price=($fetch_cart['price']* $fetch_cart['quantity']); 
                       $grand_total=$total+=$total_price;
                    
                

            ?>
            <span><?= $fetch_cart['name'];?>(<?= $fetch_cart['quantity']?>)</span>
            <?php
                    }
                }
            
            ?>
            <span class="grand_total">Total amount payable : Rs.<?= $grand_total;?></span>
        </div>
        <form method="post">
    <div class="input-field">
        <label>your name</label>
        <input type="text" name="name" placeholder="enter your name" required>
    </div>
    <div class="input-field">
        <label>your number</label>
        <input type="text" name="number" placeholder="enter your phone number" required>
    </div>
    <div class="input-field">
        <label>your email</label>
        <input type="text" name="email" placeholder="enter your email" required>
    </div>
    <div class="input-field">
        <label>select payment method</label>
        <select name="method" required>
            <option selected disabled>select payment method</option>
            <option value="cash on delivery">cash on delivery</option>
            <option value="credit card">credit card</option>
        </select>
    </div>
    <div class="input-field">
        <label>address line 1:</label>
        <input type="text" name="flate" placeholder="eg: no. 234/1 A" required>
    </div>
    <div class="input-field">
        <label>address line 2:</label>
        <input type="text" name="street" placeholder="eg: street name" required>
    </div>
    <div class="input-field">
        <label>city:</label>
        <input type="text" name="city" placeholder="eg: koswatta" required>
    </div>
    <div class="input-field">
        <label>state:</label>
        <input type="text" name="state" placeholder="eg: colombo" required>
    </div>
    <div class="input-field">
        <label>country:</label>
        <input type="text" name="country" placeholder="eg: Sri Lanka" required>
    </div>
    <div class="input-field">
        <label>pin code:</label>
        <input type="number" name="pin" placeholder="eg: 23343" required>
    </div>
    <input type="submit" name="order_btn" class="btn" value="order now">
</form>

    </div>
   
    
    <?php include 'footer.php' ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>