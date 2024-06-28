<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
if (!$isLoggedIn) {
    header("Location: http://localhost/Taskmaster/index.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supprimer une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_task'])) {
    $taskId = $_POST['task_id'];
    $sql_delete_task = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($sql_delete_task);
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $stmt->close();

    // Redirection après suppression
    header("Location: http://localhost/Taskmaster/kanbanproject.php");
    exit;
}

$conn->close();
?>
