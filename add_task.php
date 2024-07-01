<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $title = $_POST['title'];
    $description = $_POST['description'];
    $catégorie = $_POST['catégorie'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $list = $_POST['list'];

    $stmt = $conn->prepare("INSERT INTO tasks (title, description, catégorie, deadline, priority, list) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $catégorie, $deadline, $priority, $list]);

    header("Location: index.php");
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
