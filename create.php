<?php
include './db/config.php';

$nameError = $departmentError = $designationError = $emailError = $phoneError = $warning = '';

$name = $department = $designation = $email = $phone = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (empty($name)) {
        $nameError = 'Name is required';
    }

    if (empty($department)) {
        $departmentError = 'Department is required';
    }

    if (empty($designation)) {
        $designationError = 'Designation is required';
    }

    if (empty($email)) {
        $emailError = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Invalid email format';
    }

    if (empty($phone)) {
        $phoneError = 'Phone number is required';
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $phoneError = 'Phone number must be 10 digits';
    }

    if (empty($nameError) && empty($departmentError) && empty($designationError) && empty($emailError) && empty($phoneError)) {
        try {
            $isEmployeeAlreadyExist = $conn->query("SELECT * FROM employees WHERE email = '$email'");
            if ($isEmployeeAlreadyExist->num_rows == 0) {
                $sql = "INSERT INTO employees (name, department, designation, email, phone) VALUES ('$name', '$department', '$designation', '$email', '$phone')";
                $result = $conn->query($sql);
                if ($result) {
                    echo "<script>
                    alert('Employee created successfully')
                    window.location.href = './index.php', 1000
                    </script>";
                } else {
                    $warning = 'Failed to create employee. Please try again.';
                }
            } else {
                $emailError = 'Email already exists';
            }
        } catch (\Throwable $th) {
            $warning = 'Failed to connect to the database';
        }
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Create Employee</title>
</head>

<body>
    <div class="form-container">
        <form method="post" action="">
            <div class="form-title">Create Employee</div>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" onfocus="clearError('nameError')" />
            <span class="error" id="nameError"><?php echo $nameError; ?></span>

            <label for="department">Department:</label>
            <select id="department" name="department" onfocus="clearError('departmentError')">
                <option value="">Select Department</option>
                <option value="HR">HR</option>
                <option value="IT">IT</option>
                <option value="Finance">Finance</option>
                <option value="Sales">Sales</option>
                <option value="Others">Others</option>
            </select>
            <span class="error" id="departmentError"><?php echo $departmentError; ?></span>

            <label for="designation">Designation:</label>
            <input type="text" id="designation" name="designation" value="<?php echo $designation; ?>" onfocus="clearError('designationError')" />
            <span class="error" id="designationError"><?php echo $designationError; ?></span>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" onfocus="clearError('emailError')" />
            <span class="error" id="emailError"><?php echo $emailError; ?></span>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" onfocus="clearError('phoneError')" />
            <span class="error" id="phoneError"><?php echo $phoneError; ?></span>
            <div class="error"><?php echo $warning; ?></div>
            <button class="btn" name="submit" type="submit">Create Employee</button>
        </form>
        
        <p style="text-align: center;">Go back to <a href="./index.php" class="link">Employee List</a></p>
    </div>

    <script>
        function clearError(errorId) {
            document.getElementById(errorId).textContent = '';
            document.getElementById('warning').textContent = '';
        }
    </script>
</body>

</html>
