<?php
session_start();
require_once "functions.php";
date_default_timezone_set("Europe/Prague");

// Kontrola přihlášení
if (!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit;
}

require './db_config.php';

if (isset($_POST['update'])) {
    $time_tracking_id = $_POST['time_tracking_id'];
    $project_id = $_POST['project'];
    $task_name = $_POST['name'];
    $note = $_POST['note'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Převod času na UNIX timestamp
    $start_timestamp = strtotime($start_time);
    $end_timestamp = strtotime($end_time);

    // Aktualizace polí v databázi
    $sql = "UPDATE timetrackr SET project_id = ?, name = ?, note = ?, start_time = ?, end_time = ? WHERE time_tracking_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_id, $task_name, $note, $start_timestamp, $end_timestamp, $time_tracking_id]);

    header("Location: timetrackr_list.php");
    exit;
} else if (isset($_POST['delete'])) {
    $time_tracking_id = $_POST['time_tracking_id'];

    // Odstranění záznamu o sledování času
    $sql = "DELETE FROM timetrackr WHERE time_tracking_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$time_tracking_id]);

    echo "Time tracking deleted!";
    header("Location: timetrackr_list.php");
    exit;
} else {
    echo "Invalid request!";
}
?>
