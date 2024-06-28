<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

try {
    // Créer une nouvelle connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurer le mode d'erreur PDO pour lancer une exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Préparer et exécuter la requête SQL pour récupérer les tâches
    $stmt = $conn->prepare("SELECT * FROM tasks");
    $stmt->execute();

    // Récupérer les résultats
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Erreur de connexion: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau Kanban des Tâches</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        .kanban-column {
            min-height: 400px;
        }
    </style>
</head>
<body class="bg-purple-600 min-h-screen">
  <div class="fixed bg-white text-yellow-600 px-10 py-1 z-10 w-full">
    <div class="flex items-center justify-between py-2 text-5x1">
        <div class="font-bold text-orange-500 text-xl">Task<span class="text-purple-600">Master</span></div>
            <?php if ($isLoggedIn): ?>
                <a href="logout.php" class="ml-4 px-5 py-2 pt-1 text-white rounded-full bg-purple-500 hover:bg-purple-600">Logout</a>
            <?php else: ?>
                <a href="login.php" class="ml-4 px-5 py-2 pt-1 text-white rounded-full bg-purple-500 hover:bg-purple-600">Login</a>
            <?php endif; ?>
    </div>
</div>
    <div class="container mx-16 p-4 bg-purple-600">
        <h1 class="text-2xl text-orange-500 font-bold mb-4">Tableau Kanban des Tâches</h1>
        
        <div class="container mx-auto p-6 bg-white rounded shadow-lg">
        <div class="flex justify-between mb-4">
            <a href="dashboard.php" class="bg-gray-400 text-white px-4 py-2 rounded">Retour au Dashboard</a>
            <div class="flex space-x-4">
                <button onclick="document.getElementById('add-task-modal').style.display='block'" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une tâche</button>
                <a href="download_csv.php" class="bg-yellow-600 text-white px-4 py-2 rounded">Télécharger les données (CSV)</a>
            </div>
        </div>

        <div class="flex space-x-4">
            <!-- Colonne To Do -->
            <div class="kanban-column w-1/3 bg-gray-100 p-4 rounded">
                <h2 class="text-xl text-purple-500 font-bold mb-2">To Do</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['list'] == 'To Do'): ?>
                        <div class="bg-white p-2 mb-2 shadow rounded">
                            <h3 class="font-semibold"><?php echo htmlspecialchars($task['title']); ?></h3>
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($task['catégorie']); ?></p>
                            <p><strong>Deadline :</strong> <?php echo htmlspecialchars($task['deadline']); ?></p>
                            <p><strong>Priority :</strong> <?php echo htmlspecialchars($task['priority']); ?></p>
                            <div class="mt-2">
                                <button onclick="document.getElementById('edit-task-modal-<?php echo $task['id']; ?>').style.display='block'" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                                <form action="delete_task.php" method="post" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Colonne In Progress -->
            <div class="kanban-column w-1/3 bg-gray-100 p-4 rounded">
                <h2 class="text-xl text-yellow-500 font-bold mb-2">In Progress</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['list'] == 'In Progress'): ?>
                        <div class="bg-white p-2 mb-2 shadow rounded">
                            <h3 class="font-semibold"><?php echo htmlspecialchars($task['title']); ?></h3>
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($task['catégorie']); ?></p>
                            <p><strong>Deadline :</strong> <?php echo htmlspecialchars($task['deadline']); ?></p>
                            <p><strong>Priority :</strong> <?php echo htmlspecialchars($task['priority']); ?></p>
                            <div class="mt-2">
                                <button onclick="document.getElementById('edit-task-modal-<?php echo $task['id']; ?>').style.display='block'" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                                <form action="delete_task.php" method="post" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Colonne Done -->
            <div class="kanban-column w-1/3 bg-gray-100 p-4 rounded">
                <h2 class="text-xl text-green-600 font-bold mb-2">Done</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['list'] == 'Done'): ?>
                        <div class="bg-white p-2 mb-2 shadow rounded">
                            <h3 class="font-semibold"><?php echo htmlspecialchars($task['title']); ?></h3>
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($task['catégorie']); ?></p>
                            <p><strong>Deadline :</strong> <?php echo htmlspecialchars($task['deadline']); ?></p>
                            <p><strong>Priority :</strong> <?php echo htmlspecialchars($task['priority']); ?></p>
                            <div class="mt-2">
                                <button onclick="document.getElementById('edit-task-modal-<?php echo $task['id']; ?>').style.display='block'" class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                                <form action="delete_task.php" method="post" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter une tâche -->
    <div id="add-task-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" style="display:none;">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Ajouter une tâche</h2>
            <form action="add_task.php" method="post">
                <div class="mb-4">
                    <label for="title" class="block font-semibold">Titre</label>
                    <input type="text" name="title" id="title" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block font-semibold">Description</label>
                    <textarea name="description" id="description" class="w-full border p-2 rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="catégorie" class="block font-semibold">Catégorie</label>
                    <input type="text" name="catégorie" id="catégorie" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="deadline" class="block font-semibold">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="priority" class="block font-semibold">Priority</label>
                    <input type="text" name="priority" id="priority" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="list" class="block font-semibold">Liste</label>
                    <select name="list" id="list" class="w-full border p-2 rounded" required>
                        <option value="To Do">To Do</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Done">Done</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('add-task-modal').style.display='none'" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modals pour modifier les tâches -->
    <?php foreach ($tasks as $task): ?>
    <div id="edit-task-modal-<?php echo $task['id']; ?>" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center" style="display:none;">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Modifier la tâche</h2>
            <form action="edit_task.php" method="post">
                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                <div class="mb-4">
                    <label for="title-<?php echo $task['id']; ?>" class="block font-semibold">Titre</label>
                    <input type="text" name="title" id="title-<?php echo $task['id']; ?>" value="<?php echo htmlspecialchars($task['title']); ?>" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description-<?php echo $task['id']; ?>" class="block font-semibold">Description</label>
                    <textarea name="description" id="description-<?php echo $task['id']; ?>" class="w-full border p-2 rounded" required><?php echo htmlspecialchars($task['description']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="catégorie-<?php echo $task['id']; ?>" class="block font-semibold">Catégorie</label>
                    <input type="text" name="catégorie" id="catégorie-<?php echo $task['id']; ?>" value="<?php echo htmlspecialchars($task['catégorie']); ?>" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="deadline-<?php echo $task['id']; ?>" class="block font-semibold">Deadline</label>
                    <input type="date" name="deadline" id="deadline-<?php echo $task['id']; ?>" value="<?php echo htmlspecialchars($task['deadline']); ?>" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="priority-<?php echo $task['id']; ?>" class="block font-semibold">Priority</label>
                    <input type="text" name="priority" id="priority-<?php echo $task['id']; ?>" value="<?php echo htmlspecialchars($task['priority']); ?>" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="list-<?php echo $task['id']; ?>" class="block font-semibold">Liste</label>
                    <select name="list" id="list-<?php echo $task['id']; ?>" class="w-full border p-2 rounded" required>
                        <option value="To Do" <?php if ($task['list'] == 'To Do') echo 'selected'; ?>>To Do</option>
                        <option value="In Progress" <?php if ($task['list'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Done" <?php if ($task['list'] == 'Done') echo 'selected'; ?>>Done</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="document.getElementById('edit-task-modal-<?php echo $task['id']; ?>').style.display='none'" class="mr-4 px-4 py-2 bg-gray-500 text-white rounded">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
    <?php endforeach; ?>

</body>
</html>
