<?php
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Employee not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
    <h2 style="margin-top: 30px;">Employee Details</h2>

        <table>
            <tr>
                <th>Name</th>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <th>Department</th>
                <td><?php echo $row['department']; ?></td>
            </tr>
            <tr>
                <th>Designation</th>
                <td><?php echo $row['designation']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $row['email']; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
            <td><?php echo $row['phone']; ?></td>
        </tr>
    </table>

    <p style="margin-top: 20px;">Back to<a href="index.php"> Employee List</a></p>
</div>
</body>

</html>
