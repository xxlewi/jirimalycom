<?php
session_start();

// Kontrola přihlášení
if (!isset($_SESSION['username'])) {
    header('Location: user_login.php');
    exit;
}

require './db_config.php';
require_once "menu.php";

// Vytvoření nového projektu
if (isset($_POST['create_project'])) {
    $projectName = $_POST['project_name'];

    // Vložení nového projektu do databáze
    $sql = "INSERT INTO timetrackr_projects (user_id, name) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id'], $projectName]);

    echo "New project created!";
}

// Aktualizace názvu projektu
if (isset($_POST['update_project'])) {
    $projectId = $_POST['project_id'];
    $projectName = $_POST['project_name'];

    // Aktualizace názvu projektu v databázi
    $sql = "UPDATE timetrackr_projects SET name = ? WHERE project_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$projectName, $projectId, $_SESSION['user_id']]);

    echo "Project name updated!";
}

// Odstranění projektu
if (isset($_POST['delete_project'])) {
    $projectId = $_POST['project_id'];

    // Odstranění projektu z databáze
    $sql = "DELETE FROM timetrackr_projects WHERE project_id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$projectId, $_SESSION['user_id']]);

    echo "Project deleted!";
}

// Získání všech projektů uživatele
$sql = "SELECT * FROM timetrackr_projects WHERE user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$projects = $stmt->fetchAll();
?>

<h2>Create New Project</h2>

<form method="post" action="timetrackr_projects.php">
    <label for="project_name">Project Name:</label>
    <input type="text" name="project_name" required>
    <button type="submit" name="create_project">Create Project</button>
</form>

<h2>Projects</h2>

<table>
    <thead>
        <tr>
            <th>Project Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project) : ?>
            <tr>
                <form method="post" action="timetrackr_projects.php">
                    <input type="hidden" name="project_id" value="<?php echo $project['project_id']; ?>">
                    <td>
                        <input type="text" name="project_name" value="<?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?>">
                    </td>
                    <td>
                        <button type="submit" name="update_project">Update</button>
                        <button type="submit" name="delete_project">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
