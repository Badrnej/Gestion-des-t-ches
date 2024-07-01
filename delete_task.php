<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
