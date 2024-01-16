<?php
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $name = $_POST["name"];
    $department = $_POST["department"];
    $designation = $_POST["designation"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $sql = "UPDATE employees SET name='$name', department='$department', designation='$designation', email='$email', phone='$phone' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: ";
    }
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM employees WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form method="post" action="">
    <div class="form-title">Update Employee</div>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

        <label for="department">Department:</label>
        <select name="department" required>
            <option value="HR" <?php echo ($row['department'] === 'HR') ? 'selected' : ''; ?>>HR</option>
            <option value="IT" <?php echo ($row['department'] === 'IT') ? 'selected' : ''; ?>>IT</option>
            <option value="Finance" <?php echo ($row['department'] === 'Finance') ? 'selected' : ''; ?>>Finance</option>
            <option value="Sales" <?php echo ($row['department'] === 'Sales') ? 'selected' : ''; ?>>Sales</option>
            <option value="others" <?php echo ($row['department'] === 'others') ? 'selected' : ''; ?>>others</option>
        </select>

        <label for="designation">Designation:</label>
        <input type="text" name="designation" value="<?php echo $row['designation']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

        <button type="submit">Update Employee</button>
    </form>

    <p style="text-align: center;">Go back to <a href="./index.php" class="link">Employee List</a></p>
    
</body>

</html>
