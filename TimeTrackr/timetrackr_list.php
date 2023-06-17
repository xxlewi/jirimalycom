<?php
// session_start();
// date_default_timezone_set("Europe/Prague");

// // Kontrola přihlášení
// if (!isset($_SESSION['username'])) {
//     header('Location: user_login.php');
//     exit;
// }

// require '../it_config/db_config.php';
// require_once "../it_config/functions.php";

// Získání ukončených záznamů o sledování času pro přihlášeného uživatele
$sql = "SELECT timetrackr.*, timetrackr_projects.name as project_name FROM timetrackr 
        LEFT JOIN timetrackr_projects ON timetrackr.project_id = timetrackr_projects.project_id
        WHERE timetrackr.user_id = ? AND timetrackr.end_time IS NOT NULL";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$time_trackings = $stmt->fetchAll();
?>

<h2 class="timetrackr_list_heading">Completed Time Trackings</h2>

<table class="timetrackr_list_table">
    <thead>
        <tr>
            <th>Project</th>
            <th>Task</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Duration</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($time_trackings as $time_tracking) : ?>
            <?php
            $start_time = date('Y-m-d H:i:s', $time_tracking['start_time']);
            $end_time = date('Y-m-d H:i:s', $time_tracking['end_time']);
            $duration = $time_tracking['end_time'] - $time_tracking['start_time'];
            ?>
            <tr>
                <form method="post" action="./timetrackr_update.php" class="timetrackr_list_form">
                    <input type="hidden" name="time_tracking_id" value="<?php echo $time_tracking['time_tracking_id']; ?>">
                    <td>
                        <select name="project" id="project" class="timetrackr_list_select" required>
                            <?php
                            // Získání všech projektů uživatele
                            $sql = "SELECT * FROM timetrackr_projects WHERE user_id = ?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$_SESSION['user_id']]);
                            $projects = $stmt->fetchAll();

                            foreach ($projects as $project) {
                                $selected = ($project['project_id'] == $time_tracking['project_id']) ? 'selected' : '';
                                echo '<option value="' . $project['project_id'] . '" ' . $selected . '>' . htmlspecialchars($project['name'], ENT_QUOTES) . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                    <td><input type="text" name="name" value="<?php echo htmlspecialchars($time_tracking['name'], ENT_QUOTES); ?>" class="timetrackr_list_input"></td>
                    <td><input type="datetime-local" name="start_time" value="<?php echo date('Y-m-d\TH:i', $time_tracking['start_time']); ?>" class="timetrackr_list_input"></td>
                    <td><input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i', $time_tracking['end_time']); ?>" class="timetrackr_list_input"></td>
                    <td><?php echo formatDuration($duration); ?></td>
                    <td><input type="text" name="note" value="<?php echo htmlspecialchars($time_tracking['note'], ENT_QUOTES); ?>" class="timetrackr_list_input"></td>
                    <td>
                        <button type="submit" name="update" class="timetrackr_list_button_update">Update</button>
                        <form method="post" action="timetrackr_delete.php" class="timetrackr_list_form_delete">
                            <input type="hidden" name="time_tracking_id" value="<?php echo $time_tracking['time_tracking_id']; ?>">
                            <button type="submit" name="delete" class="timetrackr_list_button_delete">Delete</button>
                        </form>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

                       
