<?php
// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Utilisez $_POST['task_id'], $_POST['task_title'], etc. pour construire votre requête UPDATE

    $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description, category = :category, priority = :priority WHERE id = :id");
    $stmt->bindParam(':id', $_POST['task_id']);
    $stmt->bindParam(':title', $_POST['task_title']);
    $stmt->bindParam(':description', $_POST['task_description']);
    $stmt->bindParam(':category', $_POST['task_category']);
    $stmt->bindParam(':priority', $_POST['task_priority']);
    $stmt->execute();

    echo "Tâche mise à jour avec succès!";
} catch(PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}

</form>
                <form method="POST" action="edit_task.php">
                    <label for="task_title">Titre:</label><br>
                    <input type="text" id="task_title" name="task_title"><br>
                    <label for="task_description">Description:</label><br>
                    <textarea id="task_description" name="task_description"></textarea><br>
                    <label for="task_category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select id="task_category" name="task_category" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <!-- Options de catégories ici -->
                            <option value="important">informatique</option>
                            <option value="normal">infography</option>
                            <option value="not important">reseau</option>
                        </select>
                        <label for="task_priority" class="block text-sm font-medium text-gray-700">Priorité</label>
                        <select id="task_priority" name="task_priority" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="important">Important</option>
                            <option value="normal">Normal</option>
                            <option value="not_important">Non important</option>
                        </select><br>
                        <div class="flex justify-end">
                        <button type="submit" name="edit_task" class="px-4 py-2 bg-purple-600 text-white rounded-md">Modifier la tâche</button>
                    </div>
                </form>