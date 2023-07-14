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

        // Generate a unique verification token
        $token = bin2hex(random_bytes(50));

        // Save the verification token to the database
        $sql = "UPDATE Users SET email_verification_token = ? WHERE user_name = ?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$token, $username]);

        // Send a verification email
        $verification_link = "https://onestopit.cz/verify.php?token=$token";
        $subject = "Please verify your email address";
        $body = "Thank you for registering. Click on this link to verify your email address: $verification_link";
        mail($email, $subject, $body);




        // log the user in
        $_SESSION['username'] = $username;

        // redirect to index.php
        header('Location: ../index.php');
        exit;
    }
}
?>
<style>
    .error {
        color: red;
        margin-bottom: 10px;
        text-align: center;
    }

    .user_registration_body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .user_registration_form {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        width: 300px;
    }

    .user_registration_form input[type="text"], .user_registration_form input[type="password"], .user_registration_form input[type="email"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .user_registration_form button {
        background-color: #007BFF;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        cursor: pointer;
        margin-top: 10px;
    }

    .user_registration_form button:hover {
        background-color: #0056b3;
    }

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

