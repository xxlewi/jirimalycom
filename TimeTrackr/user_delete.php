<?php
require './db_config.php';

if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];

    $sql = "DELETE FROM Users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    
    echo "User deleted successfully!";
} else {
    echo "No user_id provided";
}
?>
