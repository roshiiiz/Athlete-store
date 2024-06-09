<?php
session_start();

$servername = "localhost";  // Update with your server name
$username = "root";         // Update with your database username
$password = "";             // Update with your database password
$dbname = "athletestore";   // Update with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate password
function validatePassword($password) {
    if (strlen($password) < 6) {
        return "Password must be at least 6 characters long.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        return "Password must contain at least one number.";
    }
    if (!preg_match('/[\W]/', $password)) {
        return "Password must contain at least one special character.";
    }
    return true;
}

// Get the current timestamp
$current_time = date('Y-m-d H:i:s');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        // Registration process
        // Get form data
        if (isset($_POST['usernamee']) && isset($_POST['emaill']) && isset($_POST['passworddd'])) {
            $username = $_POST['usernamee'];
            $email = $_POST['emaill'];
            $password = $_POST['passworddd'];

            // Validate email format
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Invalid email format";
            } else {
                // Validate password
                $passwordValidationResult = validatePassword($password);
                if ($passwordValidationResult !== true) {
                    echo $passwordValidationResult;
                } else {
                    // Check if email already exists
                    $check_email_query = "SELECT * FROM register WHERE email='$email'";
                    $email_result = $conn->query($check_email_query);
                    if ($email_result->num_rows > 0) {
                        echo "Email already exists.";
                    } else {
                        // Insert form data into register table
                        $sql_register = "INSERT INTO register (username, email, password, login_time) VALUES ('$username', '$email', '$password', '$current_time')";
                        try {
                            $conn->query($sql_register);
                            $_SESSION['registration_message'] = "Registration successful";
                            header("Location: Account.php");
                            exit();
                        } catch (mysqli_sql_exception $e) {
                            if ($e->getCode() == 1062) {
                                echo "Username already exists.";
                            } else {
                                echo "Error: " . $e->getMessage();
                            }
                        }
                    }
                }
            }
        } else {
            echo "Missing required form fields";
        }
    } elseif (isset($_POST['login'])) {
        // Login process
        // Get form data
        if (isset($_POST['username']) && isset($_POST['passwordd'])) {
            $username = $_POST['username'];
            $password = $_POST['passwordd'];

            // Use prepared statements for security
            $stmt = $conn->prepare("SELECT * FROM register WHERE username=? AND password=?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Save login information in the loginform table
                $login_stmt = $conn->prepare("INSERT INTO loginform (username, password, login_time) VALUES (?, ?, NOW())");
                $login_stmt->bind_param("ss", $username, $password);
                if ($login_stmt->execute()) {
                    $_SESSION['login_message'] = "Login successful!";
                    $_SESSION['username'] = $username;
                    header("Location: Account.php");
                    exit();
                } else {
                    echo "Failed to save login information: " . $login_stmt->error;
                }
                $login_stmt->close();
            } else {
                echo "Invalid username or password.";
            }
            $stmt->close();
        } else {
            echo "Missing form fields for login.";
        }
    }
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        $feedback_username = $_POST['name'];
        $feedback_email = $_POST['email'];
        $feedback_message = $_POST['message'];

        // Insert feedback form data into feedback table
        $login_time = date('Y-m-d H:i:s');
        $sql_feedback = "INSERT INTO feedback (name, email, message,login_time) VALUES ('$feedback_username', '$feedback_email', '$feedback_message','$login_time')";

        if ($conn->query($sql_feedback) === TRUE) {
            echo "Records added to feedback successfully.";
        } else {
            echo "ERROR: Could not able to execute $sql_feedback. " . $conn->error;
        }
    }
    elseif (isset($_POST['order'])) {
        // Order process
        // Get form data
        if (isset($_POST['Fullname']) && isset($_POST['number']) && isset($_POST['address'])) {
            $fullname = $_POST['Fullname'];
            $number = $_POST['number'];
            $address = $_POST['address'];

            // Insert form data into orders table
            $sql_order = "INSERT INTO orders (fullname, number, address, login_time) VALUES ('$fullname', '$number', '$address', '$current_time')";
            if ($conn->query($sql_order) === TRUE) {
                // Clear the session cart
                unset($_SESSION['cart']);
                echo "Order placed successfully";
            } else {
                echo "Error: " . $sql_order . "<br>" . $conn->error;
            }
        } else {
            echo "Missing required form fields";
        }
    }
}

// Close the database connection
$conn->close();
?>
