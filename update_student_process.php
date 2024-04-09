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
    $student_id = $_POST['id'];
    $new_fullname = $_POST['fullname'];
    $new_email = $_POST['email'];
    $new_password = $_POST['password'];

    // Validate form data (you can add more validation as needed)
    if (!empty($student_id) && !empty($new_fullname) && !empty($new_email) && !empty($new_password)) {
        // SQL query to update student data in database
        $sql = "UPDATE users SET fullname='$new_fullname', email='$new_email', password='$new_password' WHERE id=$student_id";

        if ($conn->query($sql) === TRUE) {
            // Redirect to home page after successful update
            header("Location: home_page.php");
            exit(); // Make sure to exit after redirecting
        } else {
            // Handle database update error
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Handle validation errors
        echo "<p style='color: red;'>Please fill out all fields.</p>";
    }

    // Close database connection
    $conn->close();
} else {
    echo "Form not submitted";
}
?>