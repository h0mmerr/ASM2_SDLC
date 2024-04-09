<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
</head>

<body>
    <?php
    // Check if student ID is provided
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $student_id = $_GET['id'];

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

        // Fetch student data from database based on ID
        $sql = "SELECT fullname, email, password FROM users WHERE id = $student_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $fullname = $row["fullname"];
            $email = $row["email"];
            $password = $row["password"];
        } else {
            echo "No student found with ID: $student_id";
            exit();
        }

        // Close database connection
        $conn->close();
    } else {
        echo "No student ID provided";
        exit();
    }
    ?>

    <h2>Update Student</h2>
    <form method="post" action="update_student_process.php">
        <input type="hidden" name="id" value="<?php echo $student_id; ?>"> <!-- Hidden field to store student ID -->

        <!-- Form fields for updating student data -->
        <label for="fullname">Full Name:</label><br>
        <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>

</html>