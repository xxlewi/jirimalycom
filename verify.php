<?php

require './it_config/db_config.php';
// verify.php

$token = $_GET['token'];

// Check if a user exists with this token
$sql = "SELECT * FROM Users WHERE email_verification_token = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token]);
$user = $stmt->fetch();

if ($user) {
    // User found, verify their email
    $sql = "UPDATE Users SET email_verified = TRUE, email_verification_token = NULL WHERE email_verification_token = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$token]);
    echo "Your email has been verified! You can now log in.";
} else {
    echo "Invalid verification link.";
}


?>