<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Website - Contact Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your existing CSS styles here */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #e6f7ff, #33adff);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        h1 {
            color: #ff5733;
        }
        h2 {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            font-style: oblique;
            font-size: 30px;
            background: linear-gradient(to right, #ff5733, #2600e6);
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
            background-color: #00f0fb;
            color: #000000;
            margin: 10% 0% 0% 4%;
            width: 500px;
            font-size: 26px;
            font-family: 'Arial', sans-serif;
            transition: all ease 0.5s;
            cursor: pointer;
        }
        button:hover {
            -webkit-box-reflect: below 1px linear-gradient(transparent,#0005);
            box-shadow: 0 0 5px #03e9f4, 0 0 15px #03e9f4, 0 0 25px #03e9f4, 0 0 100px #03e9f4;
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
    <h1>Contact Us</h1>
</header>

<div class="container">
    <h2>Athlete Store</h2>

    <section>
        <p>
            Have questions or feedback? We'd love to hear from you! Use the form below to get in touch.
        </p>

        <form id="feedback" action="process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>

        <div class="contact-info">
            <p>Or, feel free to reach us directly:</p>
            <a href="mailto:info@athletewebsite.com"><i class="far fa-envelope"></i></a>
            <a href="tel:+11234567890"><i class="fas fa-phone"></i></a>
            <a href="https://www.instagram.com/roshiiiz/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/1234567890" target="_blank"><i class="fab fa-whatsapp"></i></a>
        </div>
    </section>
</div>

<footer>
    &copy; 2024 Athlete Website. All rights reserved.
</footer>

<script>
    document.getElementById("contactForm").addEventListener("submit", function(event) {
        event.preventDefault();
        let email = document.getElementById("email").value;
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (emailPattern.test(email)) {
            // Valid email format
            document.getElementById("contactForm").reset(); // Reset form
            alert("Welcome! Thank you for reaching out."); // Show welcome message
        } else {
            alert("Please enter a valid email address."); // Show error message
        }
    });
</script>

</body>
</html>
