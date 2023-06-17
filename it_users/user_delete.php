<?php
require_once '../it_config/db_config.php';

if (isset($_POST['user_id_selected'])) {
    $user_id = $_POST['user_id_selected'];

    // Nejprve odstraníme všechny záznamy z tabulky `timetrackr`, které patří uživateli
    $sql = "DELETE FROM timetrackr WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    // Poté odstraníme všechny záznamy z tabulky `timetrackr_projects`, které patří uživateli
    $sql = "DELETE FROM timetrackr_projects WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);

    // Nakonec odstraníme samotného uživatele
    $sql = "DELETE FROM Users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    
    if ($stmt->rowCount() > 0) {
        echo "User with ID $user_id and all related records have been deleted successfully.";
    } else {
        echo "Could not delete user with ID $user_id.";
    }
}
