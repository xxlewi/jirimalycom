<?php
session_start();
date_default_timezone_set("Europe/Prague");



// Kontrola přihlášení
if(!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit;
}

require './db_config.php';
require_once "menu.php";

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

if(isset($_POST['start_timer'])) {
    $project = $_POST['project'];
    $start_time = time();

    // Vložení záznamu o sledování času
    $sql = "INSERT INTO TimeTracking (user_id, project, start_time) VALUES (?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $project, $start_time]);

    echo "Time tracking started!";
}

if(isset($_POST['stop_timer'])) {
    $time_tracking_id = $_POST['time_tracking_id'];
    $end_time = time();

    // Aktualizace záznamu o sledování času
    $sql = "UPDATE TimeTracking SET end_time = ? WHERE time_tracking_id = ? AND user_id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$end_time, $time_tracking_id, $_SESSION['user_id']]);

    echo "Time tracking stopped!";
}
?>

<h2>Time Tracker</h2>

<form method="post" action="timetrackr_index.php">
    <label for="project">Project:</label>
    <input type="text" name="project" id="project" required>
    <button type="submit" name="start_timer">Start Tracking</button>
</form>

<h3>Active Time Tracking</h3>

<table>
    <thead>
        <tr>
            <th>Project</th>
            <th>Start Time</th>
            <th>Stop Time</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Získání aktivních záznamů o sledování času
        $sql = "SELECT * FROM TimeTracking WHERE user_id = ? AND end_time IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $time_trackings = $stmt->fetchAll();

        foreach ($time_trackings as $time_tracking) {
            $start_time = date('Y-m-d H:i:s', $time_tracking['start_time']);
            $end_time = ($time_tracking['end_time']) ? date('Y-m-d H:i:s', $time_tracking['end_time']) : '';
            $duration = time() - $time_tracking['start_time'];

            echo '<tr>';
            echo '<td>' . htmlspecialchars($time_tracking['project'], ENT_QUOTES) . '</td>';
            echo '<td>' . $start_time . '</td>';
            echo '<td>' . $end_time . '</td>';
            echo '<td>' . formatDuration($duration) . '</td>';
            echo '<td><form method="post" action="timetrackr_index.php">';
            echo '<input type="hidden" name="time_tracking_id" value="' . $time_tracking['time_tracking_id'] . '">';
            echo '<button type="submit" name="stop_timer">Stop</button>';
            echo '</form></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>






<?php
// Funkce pro formátování délky trvání v sekundách na formát HH:MM:SS
function formatDuration($duration) {
    $hours = floor($duration / 3600);
    $minutes = floor(($duration % 3600) / 60);
    $seconds = $duration % 60;

    return sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
}





?>


