<?php
require_once '../it_config/db_config.php';

if (isset($_POST['user_id_selected'])) {
    $stmt = $pdo->prepare('SELECT * FROM Users WHERE user_id = ?');
    $stmt->execute([$_POST['user_id_selected']]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(32)); // Creates a random token

        $stmt = $pdo->prepare('INSERT INTO PasswordResets (user_id, token) VALUES (?, ?)');
        $stmt->execute([$user['user_id'], $token]);

        // Send email to user with link to reset_password.php?token=<token>
        $to = $user['user_email'];
        $subject = 'Password Reset Request';
        $message = "Please click on the link to reset your password: http://onestopit.cz/reset_password.php?token=$token";
        mail($to, $subject, $message);
        echo "An email has been sent to user's email address.";
    } else {
        echo "No user with that ID exists.";
    }
} else {
    echo "No user ID selected.";
}

// You might want to add a link back to the user list here
echo '<a href="user_list.php">Back to user list</a>';
?>
