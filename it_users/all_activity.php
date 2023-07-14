<?php
require_once '../it_config/db_config.php';

$sql = "SELECT UserActivity.id, Users.user_name, UserActivity.activity, UserActivity.timestamp FROM UserActivity INNER JOIN Users ON UserActivity.user_id = Users.user_id ORDER BY UserActivity.timestamp DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$activities = $stmt->fetchAll();
?>

<style>
    .all_activity_body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        /* height: 100vh; */
        margin: 0;
        padding: 20px;
    }

    .all_activity_table {
        border-collapse: collapse;
        width: 100%;
    }

    .all_activity_table, .all_activity_table th, .all_activity_table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .all_activity_table th {
        background-color: #f2f2f2;
    }
</style>

<div class="all_activity_body">
    <table class="all_activity_table">
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Activity</th>
            <th>Timestamp</th>
        </tr>
        <?php foreach ($activities as $activity): ?>
            <tr>
                <td><?= htmlspecialchars($activity['id'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($activity['user_name'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($activity['activity'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($activity['timestamp'], ENT_QUOTES) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
