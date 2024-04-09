<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add student</title>
    <style>
    /* Add some basic styling */
    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
    </style>
</head>

<body>
    <?php
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = ""; // Assuming no password is set for root
    $dbname = "btec-student";

    // Establish a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Validate form data (you can add more validation as needed)
    if (!empty($fullname) && !empty($email)) {
        // SQL query to insert student data into database
        $sql = "INSERT INTO users (fullname, email) VALUES ('$fullname', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to home page after successful insertion
            header("Location: home_page.php");
            exit(); // Make sure to exit after redirecting
        } else {
            // Handle database insertion error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Handle validation errors
        echo "<p style='color: red;'>Please fill out all fields.</p>";
    }

    // Close database connection
    $conn->close();
}
?>


    <h2>Add student</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="fullname">Student Name:</label>
        <input type="text" id="fullname" name="fullname" required>

        <label for="email">Student email:</label>
        <input type="email" id="email" name="email" required>

        <input type="submit" value="Add Student">

    </form>
</body>

</html>