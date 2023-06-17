<?php
session_start(); // start the session

require '../it_config/db_config.php';

$error = '';

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user'; // default role is user

    // Check if the username or email already exists
    $sql = "SELECT * FROM Users WHERE user_name = ? OR user_email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        // Username or email already exists, abort and inform the user
        $error = 'Username or email already exists!';
    } else {
        // Username and email are unique, proceed with the registration
        $sql = "INSERT INTO Users (user_name, user_email, user_password, user_role) VALUES (?, ?, ?, ?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$username, $email, $password, $role]);

        // log the user in
        $_SESSION['username'] = $username;

        // redirect to index.php
        header('Location: ../index.php');
        exit;
    }
}
?>

<style>
    .user_registration_form h2 {
        text-align: center;
        color: #333;
    }

    .user_registration_form p {
        text-align: center;
        margin-top: 10px;
    }

    .user_registration_form a {
        color: #007BFF;
        text-decoration: none;
    }

    .user_registration_form a:hover {
        text-decoration: underline;
    }

    /* Přidáváme stejné styly jako pro user_login... */
    .user_registration_body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f9f9f9;
    }

    .user_registration_form {
        width: 300px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .user_registration_form input {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .user_registration_form button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007BFF;
        color: #fff;
        font-size: 1em;
        cursor: pointer;
    }

    .user_registration_form button:hover {
        background-color: #0056b3;
    }
    
    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }
</style>

<body class="user_registration_body">
    <div class="user_registration_form">
        <h2>Register to <a href="/">onestopit.cz</a></h2>
        <form method="post" action="user_registration.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <?php
            if ($error) {
                echo "<p class='error'>$error</p>";
            }
            ?>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="./user_login.php">Login</a></p>
    </div>
</body>

