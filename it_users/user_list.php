<?php
require_once '../it_config/db_config.php';

$sql = "SELECT user_id, user_name, user_email, user_role FROM Users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll();

echo '<table>';
echo '<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>';
foreach ($users as $user) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($user['user_id'], ENT_QUOTES) . '</td>';
    echo '<td>' . htmlspecialchars($user['user_name'], ENT_QUOTES) . '</td>';
    echo '<td>' . htmlspecialchars($user['user_email'], ENT_QUOTES) . '</td>';
    echo '<td>' . htmlspecialchars($user['user_role'], ENT_QUOTES) . '</td>';
    echo '<td>
            <form method="POST" action="user_delete.php">
                <input type="hidden" name="user_id_selected" value="' . $user['user_id'] . '">
                <input type="submit" value="Delete">
            </form>
          </td>';
    echo '</tr>';
}
echo '</table>';
?>
