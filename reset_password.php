<?php
session_start();
require_once './it_config/db_config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if token is valid
    $stmt = $pdo->prepare('SELECT * FROM PasswordResets WHERE token = ?');
    $stmt->execute([$token]);
    $reset = $stmt->fetch();

    if (!$reset || strtotime($reset['created_at']) < time() - 15 * 60) {
        $_SESSION['error'] = 'Invalid or expired password reset token.';
        header("Location: forgot_password.php");
        exit(); // make sure to terminate script execution after redirection

    } else {
        if (isset($_POST['password']) && isset($_POST['password_confirm'])) {
            if ($_POST['password'] != $_POST['password_confirm']) {
                $_SESSION['error'] = 'Passwords do not match!';
            } elseif (strlen($_POST['password']) < 8 || !preg_match('/[A-Z]/', $_POST['password']) || !preg_match('/[0-9]/', $_POST['password'])) {
                $_SESSION['error'] = 'Password must be at least 8 characters long, contain at least one uppercase letter and one number.';
            } else {
                $newPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

                $stmt = $pdo->prepare('UPDATE Users SET user_password = ? WHERE user_id = ?');
                $stmt->execute([$newPassword, $reset['user_id']]);

                // Delete the reset token
                $stmt = $pdo->prepare('DELETE FROM PasswordResets WHERE id = ?');
                $stmt->execute([$reset['id']]);

                $_SESSION['message'] = 'Your password has been reset successfully!';
                header("Location: /it_users/user_login.php");
                exit();
            }
        }
    }
} else {
    $_SESSION['error'] = 'No password reset token provided.';
    header('Location: forgot_password.php');
    exit();
}
?>
<?php
// ... (stejný kód jako předtím) ...

?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        width: 300px;
    }

    form input[type="password"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    form button {
        background-color: #007BFF;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
        margin-top: 10px;
    }

    form button:hover {
        background-color: #0056b3;
    }

    .error {
        color: red;
        text-align: center;
    }

    .message {
        color: green;
        text-align: center;
    }

    h2 {
        text-align: center;
        color: #333;
    }
    
</style>

<body>
    <form method="post">
        <h2>Set new password for <a href="/">onestopit.cz</a></h2>
        <input type="password" name="password" placeholder="Enter your new password" required>
        <input type="password" name="password_confirm" placeholder="Confirm your new password" required>
        <button type="submit">Submit</button>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">'.$_SESSION['error'].'</p>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['message'])) {
            echo '<p class="message">'.$_SESSION['message'].'</p>';
            unset($_SESSION['message']);
        }
        ?>
    </form>
</body>
