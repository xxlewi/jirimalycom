<?php
require './db_config.php';
require_once "menu.php";


if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get user with the given username
    $sql = "SELECT user_password, user_role, user_id FROM Users WHERE user_name = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['user_password'])) {
        // Start the session and store user data
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_role'] = $user['user_role'];
        
        echo 'Successfully logged in!';
        header("Location: index.php");
    } else {
        echo 'Invalid username or password!';
    }
}
?>

<form method="post" action="user_login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
</form>
