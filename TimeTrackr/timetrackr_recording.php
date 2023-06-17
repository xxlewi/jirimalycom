<!-- timetrackr_recording.php -->

<?php
session_start();
// date_default_timezone_set("Europe/Prague");
// // require_once "functions.php";

// // Kontrola přihlášení
// if (!isset($_SESSION['username'])) {
//     header('Location: user_login.php');
//     exit;
// }

// require './db_config.php';
require_once '../it_config/db_config.php';
require_once "../it_config/functions.php";

if (isset($_POST['start_timer'])) {
    $project = $_POST['project'];
    $name = $_POST['task_name'];
    $start_time = time();

    // Vložení záznamu o sledování času
    $sql = "INSERT INTO timetrackr (user_id, project_id, name, start_time) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $project, $name, $start_time]);

    header("Location: ./");  // Přesměrování zpět na stránku se sledováním času
    exit;
}

if (isset($_POST['stop_timer'])) {
    $time_tracking_id = $_POST['time_tracking_id'];
    $end_time = time();

    // Aktualizace záznamu o sledování času
    $sql = "UPDATE timetrackr SET end_time = ? WHERE time_tracking_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$end_time, $time_tracking_id, $_SESSION['user_id']]);

    header("Location: ./");  // Přesměrování zpět na stránku se sledováním času
    exit;
}

if (isset($_POST['quick_timer'])) {
    $project = $_POST['project'];
    $name = $_POST['task_name'];
    $start_time = time();
    $duration = $_POST['quick_timer'];  // Doba trvání v sekundách

    // Vložení záznamu o sledování času
    $sql = "INSERT INTO timetrackr (user_id, project_id, name, start_time, end_time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $project, $name, $start_time, $start_time + $duration]);

    header("Location: ./");  // Přesměrování zpět na stránku se sledováním času
    exit;
}

?>
