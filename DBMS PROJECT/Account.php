<?php
include('connection.php');
session_start();

// Check if registration or login message is set and display it
if (isset($_SESSION['registration_message'])) {
    echo "<script>alert('" . $_SESSION['registration_message'] . "');</script>";
    unset($_SESSION['registration_message']); // Remove the message from session
}

if (isset($_SESSION['login_message'])) {
    echo "<script>alert('" . $_SESSION['login_message'] . "');</script>";
    unset($_SESSION['login_message']); // Remove the message from session
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products - AthStore</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Add a style for the cart count */
        .cart-icon {
            position: relative;
        }
        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        .logout-btn {
            display: block;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="logo">
            <img src="images/Ath-removebg-preview.png" width="300px">
        </div>
        <nav>
            <ul>
                <li><a href="Home.html">Home</a></li>
                <li><a href="products.html">Products</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contactus.php">Contact</a></li>
                <li><a href="Account.php">Account</a></li>
            </ul>
        </nav>
        <div class="cart-icon">
            <a href="cart.html"><img src="images/icons8-cart-50.png" width="30px" height="30px"></a>
            <span class="cart-count"></span>
        </div>
    </div>
</div>
<!-----------Account Page----------->
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/football-player-png-isolated-hd-pictures-58810.png" width="100%">
            </div>
            <div class="col-2">
                <?php if (isset($_SESSION['username'])): ?>
                    <h2>Logged in as <?php echo $_SESSION['username']; ?></h2>
                    <form action="logout.php" method="post">
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                <?php else: ?>
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Register</span>
                            <hr id="Indicator">
                        </div>
                        <form action="process.php" method="post" id="LoginForm">
                            <input type="text" placeholder="Username" id="username" name="username">
                            <input type="password" placeholder="Password" id="passwordd" name="passwordd">
                            <button type="submit" name="login" class="btn">Login</button>
                            <a href="">Forgot Password</a>
                        </form>
                        <form action="process.php" method="post" id="RegForm">
                            <input type="text" placeholder="Username" id="usernamee" name="usernamee">
                            <input type="email" placeholder="Email" id="emaill" name="emaill">
                            <input type="password" placeholder="Password" id="passworddd" name="passworddd">
                            <button type="submit" name="register" class="btn">Register</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!------------js for login/reg form----------->
<script>
    var LoginForm = document.getElementById("LoginForm");
    var RegForm = document.getElementById("RegForm");
    var Indicator = document.getElementById("Indicator");

    function register(){
        RegForm.style.transform = "translateX(0px)";
        LoginForm.style.transform = "translateX(0px)";
        Indicator.style.transform = "translateX(100px)";
    }
    function login(){
        RegForm.style.transform = "translateX(300px)";
        LoginForm.style.transform = "translateX(300px)";
        Indicator.style.transform = "translateX(0px)";
    }
</script>
<!----------Footer---------->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-1">
                <img src="images/Ath-removebg-preview.png">
                <p>Our Purpose is to Sustainably Make the Pleasure <br>and Benefits of Sports
                    Accessible to the Many.
                </p>
            </div>
        </div>
        <hr>
        <p class="copyright">© 2024 RAR. All rights reserved.</p>
    </div>
</div>
<script src="cart.js" defer></script>
</body>
</html>
