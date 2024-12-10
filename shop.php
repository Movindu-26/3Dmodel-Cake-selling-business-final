<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }

    /*---------------------------- Adding products to wishlist ----------------*/
    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');
        $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');

        if(mysqli_num_rows($wishlist_number) > 0){
            $message[] = 'Product already exists in wishlist';
        } else if(mysqli_num_rows($cart_number) > 0){
            $message[] = 'Product already exists in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'Product successfully added to wishlist';
        }
    }

    /*---------------------------- Adding products to cart ----------------*/
    if(isset($_POST['add_to_cart'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');

        if(mysqli_num_rows($cart_number) > 0){
            $message[] = 'Product already exists in cart';
        } else {
            mysqli_query($conn, "INSERT INTO `cart`(`user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
            $message[] = 'Product successfully added to cart';
        }
    }
?>

<style type="text/css">
    <?php include 'main.css'; ?>

   
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
    <?php include 'header.php'; ?>

    <div class="banner-shop">
        <h1>Our Shop</h1>
        <p>Deelight Cakes is a haven for dessert lovers, offering a delightful range of handcrafted cakes and confections that transform ordinary moments into extraordinary celebrations. </p>
    </div>

    <div class="shop">
        <h1 class="title">Our products</h1>
        <?php
          if (isset($message)) {
            foreach ($message as $msg) {
                echo '
                    <div class="message">
                        <span>' . htmlspecialchars($msg) . '</span>
                        <i onclick="this.parentElement.style.display=\'none\'">&times;</i>
                    </div>
                ';
            }
        }
        ?>

        <div class="box-container">
            <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
            <form action="" method="post" class="box">
                <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>">
                    <img src="image/<?php echo $fetch_products['image']; ?>" alt="Product Image">
                </a>

                <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
                <div class="name"><?php echo $fetch_products['name']; ?></div>

                <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                <input type="hidden" name="product_quantity" value="1">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

                
            </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">No products yet</p>';
                }
            ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
