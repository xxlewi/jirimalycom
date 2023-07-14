<?php
require_once '../it_config/db_config.php';

$sql = "SELECT user_id, user_name, user_email, user_role, email_verified, user_blocked FROM Users";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll();
?>

<style>
    .user_list_body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        height: 100vh;
        margin: 0;
        padding: 20px;
    }

    .user_list_table {
        border-collapse: collapse;
        width: 100%;
    }

    .user_list_table, .user_list_table th, .user_list_table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .user_list_table th {
        background-color: #f2f2f2;
    }

    .user_list_form {
        display: inline-block;
    }

    .user_list_form input[type="submit"] {
        margin: 0 5px;
        padding: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        color: white;
    }

    .user_list_form input[type="submit"]:nth-child(1) {
        background-color: #007BFF;
    }

    .user_list_form input[type="submit"]:nth-child(2) {
        background-color: #dc3545;
    }

    .user_list_form input[type="submit"]:nth-child(3) {
        background-color: #ffc107;
    }
</style>

<div class="user_list_body">
    <table class="user_list_table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Email Verified</th>
            <th>Blocked</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['user_id'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($user['user_name'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($user['user_email'], ENT_QUOTES) ?></td>
                <td><?= htmlspecialchars($user['user_role'], ENT_QUOTES) ?></td>
                <td><?= $user['email_verified'] ? 'Yes' : 'No' ?></td>
                <td><?= $user['user_blocked'] ? 'Yes' : 'No' ?></td>
                <td>
                    <form method="POST" action="user_block.php" class="user_list_form">
                        <input type="hidden" name="user_id_selected" value="<?= $user['user_id'] ?>">
                        <input type="submit" value="<?= $user['user_blocked'] ? 'Unblock' : 'Block' ?>">
                    </form>
                    <form method="POST" action="user_delete.php" class="user_list_form">
                        <input type="hidden" name="user_id_selected" value="<?= $user['user_id'] ?>">
                        <input type="submit" value="Delete">
                    </form>
                    <form method="POST" action="forgot_password_admin.php" class="user_list_form">
                        <input type="hidden" name="user_id_selected" value="<?= $user['user_id'] ?>">
                        <input type="submit" value="Reset Password">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
