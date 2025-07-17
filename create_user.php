<?php
include('./includes/db.php'); // adjust path if needed

$username = "Siddhu";
$email = "admin@gmail.com";
$password = "1234"; // plain password

// Hash the password securely
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword, 'user']);
    echo "✅ User inserted successfully!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
