<?php
session_start();
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

    <style>
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
<div class="small-container single-product">
    <div class="row">
        <div class="col-2-1">
            <img src="images/wmts003036_1.jpg" width="100%">
        </div>
        <div class="col-2">
            <p>Home / T-Shirt</p>
            <h1 id="product-name">Red Printed Tshirt</h1>
            <h4 id="product-price">5000pkr</h4>
            <select id="product-size">
                <option>Select Size</option>
                <option>XXL</option>
                <option>XL</option>
                <option>Large</option>
                <option>Medium</option>
                <option>Small</option>
            </select>
            <input type="number" value="1" id="product-quantity" min="1">

            <a href="#" class="btn" id="add-to-cart-btn">Add to Cart</a>
            <div id="message"></div>
            <h3>Product Details</h3>
            <p>Comfortable and breathable cotton T-shirt with a classic crew neck design, perfect for casual everyday wear and versatile styling. Available in a variety of colors to suit any wardrobe.</p>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('add-to-cart-btn').addEventListener('click', function(event) {
            event.preventDefault();

            var sizeSelect = document.getElementById('product-size');
            var selectedSize = sizeSelect.options[sizeSelect.selectedIndex].value;

            if (selectedSize === 'Select Size') {
                alert('Please select a size.');
                return;
            }

            fetch('check_login_status.php')
                .then(response => response.json())
                .then(data => {
                    if (data.loggedIn) {
                        var productName = document.getElementById('product-name').textContent;
                        var productPrice = parseInt(document.getElementById('product-price').textContent.replace('pkr', ''));
                        var quantity = parseInt(document.getElementById('product-quantity').value);
                        var size = selectedSize;
                        var productImage = document.querySelector('.col-2-1 img').getAttribute('src');

                        addToCart(productName, productPrice, quantity, size, productImage);
                    } else {
                        alert('Please log in to add products to the cart.');
                    }
                });
        });

        updateCartCount();
    });

    function addToCart(productName, productPrice, quantity, size, productImage) {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var existingProduct = cart.find(item => item.product === productName && item.size === size);

        if (existingProduct) {
            existingProduct.quantity = Math.max(existingProduct.quantity + quantity, 0); // Prevent negative quantity
        } else {
            quantity = Math.max(quantity, 0); // Prevent negative quantity
            cart.push({ product: productName, price: productPrice, quantity: quantity, size: size, image: productImage });
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        alert('Product added to cart!');
        updateCartCount();
    }

    function updateCartCount() {
        var cart = JSON.parse(localStorage.getItem('cart')) || [];
        var cartCount = cart.reduce((count, item) => count + item.quantity, 0);
        document.querySelector('.cart-count').textContent = cartCount;
    }
</script>
<script src="cart.js" defer></script>
</body>
</html>
