<?php
session_start();
require_once './it_config/db_config.php';
$message = '';

// Initialize the session variables for reset attempts
if (!isset($_SESSION['reset_attempts'])) {
    $_SESSION['reset_attempts'] = 0;
}
if (!isset($_SESSION['last_attempt_time'])) {
    $_SESSION['last_attempt_time'] = null;
}

if (isset($_POST['email'])) {
    // Check if the last attempt was less than a minute ago
    if (time() - $_SESSION['last_attempt_time'] < 60) {
        if ($_SESSION['reset_attempts'] >= 3) {
            $message = "Too many reset attempts. Please wait a minute before trying again.";
        }
    } else {
        // If it's been more than a minute since the last attempt, reset the counter
        $_SESSION['reset_attempts'] = 0;
    }

    $stmt = $pdo->prepare('SELECT * FROM Users WHERE user_email = ?');
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user) {
        if (time() - $_SESSION['last_attempt_time'] < 60 && $_SESSION['reset_attempts'] >= 1) {
            $message = "Please wait a minute before requesting another password reset.";
        }
        $_SESSION['last_attempt_time'] = time();
        $_SESSION['reset_attempts']++;

        $token = bin2hex(random_bytes(32)); // Creates a random token

        $stmt = $pdo->prepare('INSERT INTO PasswordResets (user_id, token) VALUES (?, ?)');
        $stmt->execute([$user['user_id'], $token]);

        // Send email to user with link to reset_password.php?token=<token>
        $to = $_POST['email'];
        $subject = 'Password Reset Request';
        $message = "Please click on the link to reset your password: http://onestopit.cz/reset_password.php?token=$token";
        mail($to, $subject, $message);
        $message = "An email has been sent to your email address.";

        // Log
        $stmt = $pdo->prepare('INSERT INTO UserActivity (user_id, activity) VALUES (?, ?)');
        $stmt->execute([$user['user_id'], 'User requested password reset']);
    } else {
        $_SESSION['last_attempt_time'] = time();
        $_SESSION['reset_attempts']++;
        $message = "No user with that email address exists.";
    }
}
?>

<style>
    
    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }

    .user_login_body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .user_login_form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        width: 300px;
    }

    .user_login_form input[type="text"], .user_login_form input[type="password"], .user_login_form input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .user_login_form button {
        background-color: #007BFF;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
        margin-top: 10px;
    }

    .user_login_form button:hover {
        background-color: #0056b3;
    }


    .user_login_form h2 {
        text-align: center;
        color: #333;
    }

    .user_login_form p {
        text-align: center;
        margin-top: 10px;
    }

    .user_login_form a {
        color: #007BFF;
        text-decoration: none;
    }

    .user_login_form a:hover {
        text-decoration: underline;
    }
</style>

<body class="user_login_body">
    <div class="user_login_form">
        <h2>Reset Password for <a href="/">onestopit.cz</a></h2>
        <form method="post" action="forgot_password.php">
            <input type="email" name="email" placeholder="Enter your email" required>
            <?php
            if ($message) {
                echo "<p class='error'>$message</p>";
            }
            ?>
            <button type="submit">Reset Password</button>
        </form>
        <p>Remember your account? <a href="./it_users/user_login.php">Login</a></p>
    </div>
</body>
