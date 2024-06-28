<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

try {
    // Création d'une connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurer le mode d'erreur PDO pour lancer des exceptions
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparation de la requête SQL avec des paramètres nommés
    $stmt = $conn->prepare("INSERT INTO tasks (title, description, catégorie, deadline, priority, list) VALUES (:title, :description, :catégorie, :deadline, :priority, :list)");

    // Liaison des valeurs avec bindValue
    $stmt->bindValue(':title', $_POST['title']);
    $stmt->bindValue(':description', $_POST['description']);
    $stmt->bindValue(':catégorie', $_POST['catégorie']);
    $stmt->bindValue(':deadline', $_POST['deadline']);
    $stmt->bindValue(':priority', $_POST['priority']);
    $stmt->bindValue(':list', $_POST['list']);

    // Exécution de la requête
    $stmt->execute();

    echo "Nouvelle tâche insérée avec succès.";
} catch(PDOException $e) {
    echo "Erreur PDO : " . $e->getMessage();
}

// Fermeture de la connexion
$conn = null;
?>
