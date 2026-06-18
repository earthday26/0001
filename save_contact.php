<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    header("Location: Form.html?error=1");
    exit;
}

$full_name = trim($_POST['full_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($full_name === '' || $phone === '' || $email === '' || $message === '') {
    header("Location: Form.html?error=1");
    exit;
}

$stmt = $conn->prepare("INSERT INTO contacts (full_name, phone, email, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $full_name, $phone, $email, $message);

if ($stmt->execute()) {
    header("Location: Form.html?success=1");
} else {
    header("Location: Form.html?error=1");
}

$stmt->close();
$conn->close();
?>