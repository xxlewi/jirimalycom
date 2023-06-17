<!-- timetrackr_index.php -->

<?php
session_start();
date_default_timezone_set("Europe/Prague");

require '../it_config/db_config.php';
require "../it_config/functions.php";

// Kontrola přihlášení a zpráva pro Demo uživatele
if (!isset($_SESSION['username']) || $_SESSION['username'] === 'Demo') {
    $_SESSION['username'] = 'Demo'; // Přihlášení jako uživatel Demo
    $_SESSION['user_id'] = 8; // Předpokládané user_id pro Demo uživatele
    $_SESSION['user_role'] = 'user'; // Předpokládaná role pro Demo uživatele
}
?>

<link rel="stylesheet" type="text/css" href="./timetrackr.css">

<style>
    .demo-message {
        text-align: center;
        margin: 20px;
    }
</style>

<?php require_once "../menu.php"; 

if ($_SESSION['username'] === 'Demo') {
    // Zobrazíme zprávu uživateli
    echo "<div class='demo-message'>You are currently logged in as Demo. ";
    echo "If you want to track your own time, please <a href='../it_users/user_login.php'>log in</a> ";
    echo "or <a href='../it_users/user_registration.php'>register</a>.</div>";
}
?>

<?php require_once "./timetrackr_track.php"; ?>
<br>
<?php require_once "./timetrackr_list.php"; ?>
<br>
<?php require_once "./timetrackr_projects.php"; ?>
