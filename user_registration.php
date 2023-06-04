<?php

session_start(); // start the session

require './db_config.php';
require_once "menu.php";


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = 'user'; // default role is user

    $sql = "INSERT INTO Users (user_name, user_email, user_password, user_role) VALUES (?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$username, $email, $password, $role]);

    // log the user in
    $_SESSION['username'] = $username;

    // redirect to index.php
    header('Location: index.php');
    exit;
}

?>

<form method="post" action="user_registration.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="register">Register</button>
</form>
