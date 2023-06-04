<?php
session_start();

// Kontrola přihlášení
if (!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit;
}

require './db_config.php';

if (isset($_POST['delete'])) {
    $time_tracking_id = $_POST['time_tracking_id'];

    // Odstranění záznamu o sledování času
    $sql = "DELETE FROM TimeTracking WHERE time_tracking_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$time_tracking_id, $_SESSION['user_id']]);

    echo "Time tracking deleted!";
    header("Location: timetrackr_list.php");
    exit;
}
?>
