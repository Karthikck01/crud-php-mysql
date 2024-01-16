<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emp_crud";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ");
}
?>
