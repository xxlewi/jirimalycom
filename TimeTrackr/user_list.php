<?php
require './db_config.php';

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
    echo '<td><button onclick="deleteUser(' . $user['user_id'] . ')">Delete</button></td>';
    echo '</tr>';

}
echo '</table>';
?>


<script>
function deleteUser(userId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", 'user_delete.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            alert("User deleted successfully");
            location.reload();
        }
    }
    xhr.send("user_id=" + userId);
}
</script>
