<?php
$conn = new mysqli("localhost", "root", "", "vulndb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
