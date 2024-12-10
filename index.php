<?php
    include 'connection.php';
    session_start();

    $user_id = $_SESSION['user_id'];
    if(!isset($user_id)){
        header('location:login.php');
    }
    /*----------adding products to wishlist------------*/ 
    if(isset($_POST['add_to_wishlist'])){
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];

        $wishlist_number = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id='$user_id'") or die('query failed');
        $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id='$user_id'") or die('query failed');

        if (mysqli_num_rows($wishlist_number) > 0){
            $message[] = 'Product already in wishlist';
        }
        else if(mysqli_num_rows($cart_number) > 0){
            $message[] = 'Product already in wishlist';
        }
        else{
            mysqli_query($conn, "INSERT INTO `wishlist`(`user_id`, `pid`, `name`, `price`, `image`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
            $message[] = 'Product successfully added into wishlist';
        }
        
    }


        /*----------adding products to cart------------*/ 
        if(isset($_POST['add_to_cart'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];
    
            $cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id='$user_id'") or die('query failed');
            if(mysqli_num_rows($cart_number) > 0){
                $message[] = 'Product already in cart';
            }
            else{
                mysqli_query($conn, "INSERT INTO `cart`(`user_id`, `pid`, `name`, `price`, `quantity` `image`) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
                $message[] = 'Product successfully added into cart';
            }
            header("Location: ".$_SERVER['PHP_SELF']);
            
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Handlee&family=Hind+Mysuru:wght@300;400;500;600;700&family=Indie+Flower&family=Julius+Sans+One&family=Lobster&family=Neucha&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400..900;1,400..900&family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Handlee&family=Hind+Mysuru:wght@300;400;500;600;700&family=Indie+Flower&family=Julius+Sans+One&family=Lobster&family=Neucha&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Quicksand:wght@300..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton+SC&family=Archivo+Black&family=Bebas+Neue&family=Bungee+Spice&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Dosis:wght@200..800&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&family=Paytone+One&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Russo+One&family=Saira:ital,wght@0,100..900;1,100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=Spicy+Rice&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Akaya+Kanadaka&family=Faculty+Glyphic&family=Kavoon&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">



    <title>Deelight</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="slider-section">
        <div class="slider-show-container">
            <video autoplay muted loop>
                <source src="images/front video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            
            <!-- Overlay Content for Text and Button -->
            <div class="overlay-content">
                <h2>Where every flavor tells a story</h2>
                <p>Baked by Deelight</p>
                <a href="shop.php" class="shop-now-btn">SHOP NOW</a>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Card Section -->

    <div class="row">
        <div class="card">
            <div class="detail">
                 <span>30% OFF TODAY</span>
                    <h1>Deelight & Delicacies</h1>
                    <a href="shop.php">shop now</a>
            </div>
        </div>

        <div class="card">
            <div class="detail">
                <span>30% OFF TODAY</span>
                <h1>Deelight & Delicacies</h1>
                <a href="shop.php">shop now</a>
            </div>
        </div>

        <div class="card">
            <div class="detail">
                
                 <span>30% OFF TODAY</span>
                    <h1>Deelight & Delicacies</h1>
                    <a href="shop.php">shop now</a>
            </div>
        </div>
    </div>




    <div class="shop">
        <h1 class="title">Our Products</h1>
        
        <?php
        if(isset($message)){
            foreach ($message as $message){
                echo '    <div class="message">
        <span>'.$message.'</span>
<i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
    </div>';
            }
        }
    ?>
    <div class="box-container">
        <?php
           $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed'); 
              if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
                    

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
                        } 
                        else{
                            echo '<p class="empty">No products yet!</p>';
                        }
        ?>

    </div>
    <!-- <div class="more">
        <a href="shop.php">load more</a>
        <i class="bi bi-arrow-down"></i>
    </div> -->
    </div>


    <?php include 'footer.php'; ?>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>