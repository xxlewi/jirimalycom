<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styly.css">

    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            background-color: #333;
            padding: 15px;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }
        .navbar p {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="navbar">
    <div>
        <a href="index.php">JIRIMALY.COM</a>
    </div>
    <div>
        <?php
        if(isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo "<p>$username</p>";
            if($_SESSION['role'] == 'admin') { // Show admin tab for admin users
                echo '<a href="admin_page.php">Admin</a>';
            }
            echo '<a href="timetrackr_index.php">TimeTrackr</a>';
            echo '<a href="user_logout.php">Logout</a>';
        } else {
            echo '<a href="user_login.php">Login</a>';
            echo '<a href="user_registration.php">Register</a>';
        }
        ?>
    </div>
</div>





