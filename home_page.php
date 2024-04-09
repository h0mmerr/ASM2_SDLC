<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    .logout-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        text-decoration: none;
        padding: 5px 10px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    </style>
    <script>
    function deleteStudent(id) {
        if (confirm('Are you sure you want to delete this student?')) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "delete_student.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload(); // Refresh the page after successful deletion
                }
            };
            xhr.send("id=" + id);
        }
    }
    </script>
</head>

<body>

    <h2>Student List</h2>

    <!-- Logout button -->
    <a href="signin_page.php" class="logout-btn">Logout</a>

    <?php
    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "btec-student";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch student data from database
    $sql = "SELECT id, fullname, email FROM users";
    $result = $conn->query($sql);

    // Display student data in a table
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Student Name</th><th>Email</th><th>Update</th><th>Delete</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["fullname"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td><a href='update_student.php?id=" . $row["id"] . "'>Update</a></td>";
            echo "<td><a href='javascript:void(0);' onclick='deleteStudent(" . $row["id"] . ")'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close database connection
    $conn->close();
    ?>
    <!-- Add Student Button -->
    <a href="add_student_page.php" style="display: block; margin-top: 20px;">Add Student</a>


</body>

</html>