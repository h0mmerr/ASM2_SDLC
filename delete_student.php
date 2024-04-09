<?php
// Check if student ID is provided via POST
if(isset($_POST['id']) && !empty($_POST['id'])) {
    $student_id = $_POST['id'];

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

    // SQL query to delete student from database
    $sql = "DELETE FROM users WHERE id = $student_id";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Student record deleted successfully";
    } else {
        // Handle database deletion error
        echo "Error deleting record: " . $conn->error;
    }

    // Close database connection
    $conn->close();
} else {
    echo "No student ID provided";
}
?>