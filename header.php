<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">




    <!-- font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anton+SC&family=Archivo+Black&family=Bebas+Neue&family=Bungee+Spice&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Dosis:wght@200..800&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Oswald:wght@200..700&family=Paytone+One&family=Play:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto+Slab:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Russo+One&family=Saira:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="index.php" class="logo"><img src="images/new logo.png" alt="Deelight Cakes Logo" class="logo-img"></a>
            <nav class="navbar">
                <a href="index.php">Home</a>
                <a href="shop.php">products</a>
                <a href="order.php">orders</a>
                <a href="about.php">about us</a>
                <a href="contact.php">contact</a>



            </nav>
            <div class="icons">
                <!--a different logo for user -->
                    <i class="bi bi-person" id="user-btn"></i>
                    <?php
                        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                        $wishlist_num_rows = mysqli_num_rows($select_wishlist);
                    ?>  
                    <a href="wishlist.php"><i class="bi bi-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
                    <?php
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                        $cart_num_rows = mysqli_num_rows($select_cart);
                    ?>
                    <a href="cart.php"><i class="bi bi-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>  
                    <i class="bi bi-list" id="menu-btn"></i>
                    
                    
            </div>
            <div class="user-box">
                <p>username: <span><?php echo $_SESSION['user_name'];?></span></p>
                <p>email: <span><?php echo $_SESSION['user_email'];?></span></p>
                    <form method="post" class="logout">
                        <button name="logout" class="logout-btn">LOG OUT</button>
                    </form>
            </div>
        </div>

    </header>

    <script>
    window.addEventListener('scroll', () => {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) { // Adjust this value based on when you want the effect to trigger
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>

    
</body>
</html>

