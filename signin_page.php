<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background-color: #cbd5e0;
    }

    .container {
        padding: 2rem;
        max-width: 24rem;
        width: 100%;
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .input-group {
        margin-bottom: 1rem;
    }

    .label {
        display: block;
        font-size: 0.875rem;
        font-weight: bold;
        margin-bottom: 0.25rem;
    }

    .input {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        font-size: 1rem;
    }

    .button {
        width: 100%;
        padding: 0.75rem;
        background-color: #4a5568;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #2d3748;
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="title">Login</h2>
        <form action="signin_page.php" method="post">
            <div class="input-group">
                <label for="email" class="label">Email</label>
                <input id="email" name="email" type="email" placeholder="Enter your email" class="input">
            </div>
            <div class="input-group">
                <label for="password" class="label">Password</label>
                <input name="password" id="password" type="password" placeholder="Enter your password" class="input">
            </div>
            <button type="submit" name="button_login" class="button">Sign In</button>
            <button type="submit" name="button_regist" class="button" style="background-color: #5a67d8;">Sign
                Up</button>
        </form>
    </div>

    <?php
    $_servername = "localhost";
    $_username = "root";
    $_password = "";
    $_dbname = "btec-student";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['button_login'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $hash_password = password_hash($password, PASSWORD_DEFAULT);

            // Create a connection
            $conn = new mysqli($_servername, $_username, $_password, $_dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the email and password match
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $storedHash = $row['password'];
                // Verify the password
                if (password_verify($password, $storedHash)) {
                    // Password is correct, login successful
                    header("Location: home_page.php");
                    exit();
                } else {
                    // Password is incorrect, display an error message
                    $error = "Invalid email or password";
                }        // Login successful, redirect to a protected page
                // header("Location: home_page.php");
                exit();
            } else {
                echo "Fail";

                // Login failed, display an error message
                $error = "Invalid email or password";
            }

            // Close the database connection
            $conn->close();

            // Button 1 is clicked, redirect to page1.php
            // header("Location: page1.php");
            exit(); // Make sure to exit after redirecting
        } elseif (isset($_POST['button_regist'])) {
            // Button 2 is clicked, redirect to page2.php
            header("Location: signup_page.php");
            exit(); // Make sure to exit after redirecting
        }
    }
    ?>
</body>

</html>