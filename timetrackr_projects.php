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

<h2 class="timetrackr_projects_main_heading">Projects</h2>

<form method="post" action="timetrackr_projects.php" class="timetrackr_projects_form">
    <label for="project_name" class="timetrackr_projects_label">New Project:</label>
    <input type="text" name="project_name" class="timetrackr_projects_input" required>
    <button type="submit" name="create_project" class="timetrackr_projects_button_create">Create Project</button>
</form>

<br>

<h3 class="timetrackr_projects_subheading">Project list</h3>

<table class="timetrackr_projects_table">
    <thead class="timetrackr_projects_table_head">
        <tr class="timetrackr_projects_table_row">
            <th class="timetrackr_projects_table_header">Project Name</th>
            <th class="timetrackr_projects_table_header">Action</th>
        </tr>
    </thead>
    <tbody class="timetrackr_projects_table_body">
        <?php foreach ($projects as $project) : ?>
            <tr class="timetrackr_projects_table_row">
                <form method="post" action="timetrackr_projects.php" class="timetrackr_projects_form">
                    <input type="hidden" name="project_id" class="timetrackr_projects_input_hidden" value="<?php echo $project['project_id']; ?>">
                    <td class="timetrackr_projects_table_data">
                        <input type="text" name="project_name" class="timetrackr_projects_input" value="<?php echo htmlspecialchars($project['name'], ENT_QUOTES); ?>">
                    </td>
                    <td class="timetrackr_projects_table_data">
                        <button type="submit" name="update_project" class="timetrackr_projects_button_update">Update</button>
                        <button type="submit" name="delete_project" class="timetrackr_projects_button_delete">Delete</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


