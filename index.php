<?php require_once "menu.php";
// Výpis obsahu session
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>


<?php
    if(isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<p>Welcome, $username!</p>";
    }
?>