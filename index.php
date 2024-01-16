<?php
include 'db/config.php';

$sql = "SELECT * FROM employees";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Employee List</h2>
        <p><a href="create.php">Add New Employee</a></p>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Designation</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['department']}</td>
            <td>{$row['designation']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this employee?\");'>Delete</a>
            </td>
            </tr>";
        }
        ?>
    </table>
    
</div>
</body>

</html>
