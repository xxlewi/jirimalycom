<?php
require '../it_config/db_config.php';
// require_once "menu.php";

$error = '';

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
        
        header("Location: ../index.php");
        exit;
    } else {
        $error = 'Invalid username or password!';
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

    .user_login_form input[type="text"], .user_login_form input[type="password"] {
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
        <h2>Login to <a href="/">onestopit.cz</a></h2>
        <form method="post" action="user_login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <?php
            if ($error) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <button type="submit" name="login">Login</button>
        </form>
        <p>Don't have an account? <a href="./user_registration.php">Register</a></p>
    </div>
</body>


