<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="flex">
        <a href="admin.php" class="logo"><img src="images/new logo.png" alt="Deelight Cakes Logo" class="logo-img"><span>Admin panel</span></a>
            <nav class="navbar">
                <a href="admin.php">Home</a>
                <a href="admin_product.php">products</a>
                <a href="admin_orders.php">orders</a>
                <a href="admin_user.php">users</a>
                <a href="admin_message.php">message</a>

            </nav>
            <div class="icons">
            <i class="bi bi-person" id="user-btn"></i>  <!--a different logo for user -->
                    <i class="bi bi-list" id="menu-btn"></i>
                    
                    
            </div>
            <div class="user-box">
                <p>user: <span><?php echo $_SESSION['admin_name'];?></span></p>
                <p>email: <span><?php echo $_SESSION['admin_email'];?></span></p>
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