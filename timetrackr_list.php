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
require_once "./functions.php";

// Získání ukončených záznamů o sledování času pro přihlášeného uživatele
$sql = "SELECT * FROM TimeTracking WHERE user_id = ? AND end_time IS NOT NULL";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$time_trackings = $stmt->fetchAll();
?>

<h2>Completed Time Trackings</h2>

<table>
    <thead>
        <tr>
            <th>Project</th>
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
                <form method="post" action="timetrackr_update.php">
                    <input type="hidden" name="time_tracking_id" value="<?php echo $time_tracking['time_tracking_id']; ?>">
                    <td><?php echo htmlspecialchars($time_tracking['project'], ENT_QUOTES); ?></td>
                    <td><input type="datetime-local" name="start_time" value="<?php echo date('Y-m-d\TH:i', $time_tracking['start_time']); ?>"></td>
                    <td><input type="datetime-local" name="end_time" value="<?php echo date('Y-m-d\TH:i', $time_tracking['end_time']); ?>"></td>
                    <td><?php echo formatDuration($duration); ?></td>
                    <td><input type="text" name="note" value="<?php echo htmlspecialchars($time_tracking['note'], ENT_QUOTES); ?>"></td>
                    <td>
                        <button type="submit" name="update">Update</button>
                        <form method="post" action="timetrackr_delete.php">
                            <input type="hidden" name="time_tracking_id" value="<?php echo $time_tracking['time_tracking_id']; ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
