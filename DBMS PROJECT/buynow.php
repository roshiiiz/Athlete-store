
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Website - Place Order</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: black;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #e6f7ff, #33adff);
            color: white;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        h1 {
            color: #3352ff;
            margin: 6% 0 0% 4%;
            transition: all ease 0.5s;
        }
        h1:hover{
            text-shadow: 0 0 5px #03e9f4,0 0 15px #03e9f4,0 0 15px #03e9f4,0 0 100px #03e9f4 ;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        section {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            flex: 1;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            font-style: oblique;
            font-size: 30px;
            background: linear-gradient(to right, #ff5733, #2600e6); /* Gradient color for attractiveness */
            -webkit-background-clip: text;
            color: transparent;
        }
        p {
            font-size: 1.1em;
            color: #555;
            margin-bottom: 15px;
        }
        form {
            margin-top: 20px;
            height: 400px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            background-color: #3352ff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: all ease 0.5s;
        }
        button:hover {
            text-shadow: 0 0 5px #03e9f4,0 0 15px #03e9f4,0 0 15px #03e9f4,0 0 100px #03e9f4 ;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info p {
            margin-bottom: 10px;
        }
        .contact-info a {
            color: #33adff;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }
        .contact-info a:hover {
            text-decoration: underline;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: #fff;
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;

        }

    </style>
</head>
<body>

<header>
    <h1>Personal Details</h1>
</header>
<h2>Athlete Store</h2>
<div class="container">


    <section>
        <?php
        if(isset($_SESSION['message'])) {
            echo '<p>' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        } else {
            echo '<p>Fill the form to place your order:</p>';
        }
        ?>

        <form id="orders" action="process.php" method="post">
            <input type="hidden" name="order" value="1">
            <label for="Fullname">Full Name:</label>
            <input type="text" id="Fullname" name="Fullname" required>

            <label for="number">Number:</label>
            <input type="tel" id="number" name="number" required>

            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>

            <button type="submit" name="save" id="btn">Place Order</button><br>
        </form>
    </section>


</div>

<footer>
    &copy; 2024 RAR Athlete Website. All rights reserved.
</footer>

<script>
    document.getElementById('orders').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var form = this;

        // Clear cart in localStorage
        localStorage.removeItem('cart');

        // Use fetch to submit the form data
        fetch('process.php', {
            method: 'POST',
            body: new FormData(form)
        })
            .then(response => response.text())
            .then(data => {
                console.log(data); // For debugging purposes
                window.location.href = 'loader.html'; // Redirect to loader.html
            })
            .catch(error => console.error('Error:', error));
    });
</script>

</body>
</html>
