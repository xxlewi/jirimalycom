<!-- timetrackr_track.php -->



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
<h1 class="timetrackr_track_main_heading">TimeTrackr</h1>

<p class="timetrackr_track_description">Time Tracker je webová aplikace, která vám umožňuje efektivně sledovat a spravovat váš čas. Je navržena tak, aby vám pomohla sledovat čas strávený na různých projektech a úkolech, a tím zlepšit produktivitu a organizaci vaší práce.</p>

<form method="post" action="timetrackr_recording.php" class="timetrackr_track_form">
    <label for="project" class="timetrackr_track_label">Project:</label>
    <select name="project" id="project" class="timetrackr_track_select" required>
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
    <label for="task" class="timetrackr_track_label">Task*:</label>
    <input type="text" id="task_name" name="task_name" class="timetrackr_track_input" required>
    <button type="submit" name="start_timer" class="timetrackr_track_button_start">Start Tracking</button>
    
    <p class="quick_buttons">
    <button type="submit" name="quick_timer" value="900" class="timetrackr_track_button_quick">Quick 15m</button>
    <button type="submit" name="quick_timer" value="1800" class="timetrackr_track_button_quick">Quick 30m</button>
    <button type="submit" name="quick_timer" value="2700" class="timetrackr_track_button_quick">Quick 45m</button>
    <button type="submit" name="quick_timer" value="3600" class="timetrackr_track_button_quick">Quick 1h</button>
    </p>
</form>

<br>
<h2 class="timetrackr_track_active_heading">Active Time Tracking</h2>

<table class="timetrackr_track_active_table">
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

            echo '<tr class="timetrackr_track_active_row">';
            echo '<td class="timetrackr_track_active_project">' . htmlspecialchars($time_tracking['project_name'], ENT_QUOTES) . '</td>';
            echo '<td class="timetrackr_track_active_task">' . htmlspecialchars($time_tracking['name'], ENT_QUOTES) . '</td>';
            echo '<td class="timetrackr_track_active_start_time">' . $start_time . '</td>';
            echo '<td class="timetrackr_track_active_end_time">' . $end_time . '</td>';
            echo '<td class="timetrackr_track_active_duration">' . formatDuration($duration) . '</td>';
            echo '<td class="timetrackr_track_active_action"><form method="post" action="timetrackr_recording.php" class="timetrackr_track_active_form">';
            echo '<input type="hidden" name="time_tracking_id" value="' . $time_tracking['time_tracking_id'] . '">';
            echo '<button type="submit" name="stop_timer" class="timetrackr_track_active_button_stop">Stop</button>';
            echo '</form></td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

