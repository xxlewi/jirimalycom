<?php
session_start();
date_default_timezone_set("Europe/Prague");

// Kontrola přihlášení
if (!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit;
}

require './db_config.php';
require_once "menu.php";
require_once "functions.php";
?>

<h2>Time Tracker</h2>

<form method="post" action="timetrackr_recording.php">
    <label for="project">Project:</label>
    <select name="project" id="project" required>
        <?php
        // Získání všech projektů uživatele
        $sql = "SELECT * FROM timetrackr_projects WHERE user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $projects = $stmt->fetchAll();

        foreach ($projects as $project) {
            echo '<option value="' . $project['project_id'] . '">' . htmlspecialchars($project['name'], ENT_QUOTES) . '</option>';
        }
        ?>
    </select>
    <label for="task">Task:</label>
    <input type="text" id="task_name" name="task_name" required>
    <button type="submit" name="start_timer">Start Tracking</button>
</form>

<h3>Active Time Tracking</h3>

<table>
    <thead>
        <tr>
            <th>Project</th>
            <th>Task</th>
            <th>Start Time</th>
            <th>Stop Time</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Získání aktivních záznamů o sledování času
        $sql = "SELECT timetrackr.*, timetrackr_projects.name as project_name FROM timetrackr 
        LEFT JOIN timetrackr_projects ON timetrackr.project_id = timetrackr_projects.project_id 
        WHERE timetrackr.user_id = ? AND end_time IS NULL";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['user_id']]);
        $time_trackings = $stmt->fetchAll();

        foreach ($time_trackings as $time_tracking) {
            $start_time = date('Y-m-d H:i:s', $time_tracking['start_time']);
            $end_time = ($time_tracking['end_time']) ? date('Y-m-d H:i:s', $time_tracking['end_time']) : '';
            $duration = time() - $time_tracking['start_time'];

            echo '<tr>';
            echo '<td>' . htmlspecialchars($time_tracking['project_name'], ENT_QUOTES) . '</td>';
            echo '<td>' . htmlspecialchars($time_tracking['name'], ENT_QUOTES) . '</td>';
            echo '<td>' . $start_time . '</td>';
            echo '<td>' . $end_time . '</td>';
            echo '<td>' . formatDuration($duration) . '</td>';
            echo '<td><form method="post" action="timetrackr_recording.php">';
            echo '<input type="hidden" name="time_tracking_id" value="' . $time_tracking['time_tracking_id'] . '">';
            echo '<button type="submit" name="stop_timer">Stop</button>';
            echo '</form></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
