<?php
// db_config.php
$host = 'localhost';
$db   = 'jirimaly';
$user = 'jirimaly';
$pass = 'Borec1717';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    // echo "Successfully connected to the database.";
} catch (PDOException $e) {
    echo "Error: Failed to connect to the database: " . $e->getMessage();
}



// <?php
// // db_config.php
// $host = 'localhost';
// $db   = 'your_database';
// $user = 'your_username';
// $pass = 'your_password';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $opt = [
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false,
// ];
// $pdo = new PDO($dsn, $user, $pass, $opt);