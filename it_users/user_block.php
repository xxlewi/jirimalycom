<?php
require_once '../it_config/db_config.php';

if (!isset($_POST['user_id_selected'])) {
    // Handle error, user id was not posted
    exit;
}

$user_id = $_POST['user_id_selected'];

// First, get the current blocked status of the user
$sql = "SELECT user_blocked FROM Users WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    // Handle error, no user found with that id
    exit;
}

// Toggle the blocked status
$new_blocked_status = $user['user_blocked'] ? 0 : 1;

$sql = "UPDATE Users SET user_blocked = ? WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$new_blocked_status, $user_id]);

// Redirect back to the user list
header('Location: /it_users/admin_page.php');
exit;
?>
