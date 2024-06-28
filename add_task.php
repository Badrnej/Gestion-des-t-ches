<?php
require 'config.php';

$title = $_POST['title'];
$description = $_POST['description'];
$catégorie = $_POST['catégorie'];
$deadline = $_POST['deadline'];
$priority = $_POST['priority'];
$list = $_POST['list'];

$sql = "INSERT INTO tasks (title, description, catégorie, deadline, priority, list) VALUES (:title, :description, :catégorie, :deadline, :priority, :list)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':description', $description);
$stmt->bindParam(':catégorie', $catégorie);
$stmt->bindParam(':deadline', $deadline);
$stmt->bindParam(':priority', $priority);
$stmt->bindParam(':list', $list);

if ($stmt->execute()) {
    header('Location: kanban.php');
} else {
    echo "Erreur: " . $stmt->errorInfo()[2];
}
?>
