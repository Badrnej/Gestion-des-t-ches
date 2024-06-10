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

// Ajouter une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_task'])) {
    $task_title = $_POST['task_title'];
    $task_description = $_POST['task_description'];
    $task_category = $_POST['task_category'];
    $task_deadline = $_POST['task_deadline'];
    $task_priority = $_POST['task_priority']; // Nouvelle variable pour la priorité

    $task_completed = 0; // Valeur par défaut pour completed
    $created_at = date('Y-m-d H:i:s'); // Timestamp actuel
    $updated_at = date('Y-m-d H:i:s'); // Timestamp actuel

    $sql = "INSERT INTO tasks (catégorie, title, description, deadline, priority, completed, created_at, updated_at) 
            VALUES ('$task_category', '$task_title', '$task_description', '$task_deadline', '$task_priority', '$task_completed', '$created_at', '$updated_at')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle tâche ajoutée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Modifier une tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_task'])) {
    $task_id = $_POST['task_id'];
    $task_title = isset($_POST['task_title']) ? $_POST['task_title'] : '';
    $task_description = isset($_POST['task_description']) ? $_POST['task_description'] : '';
    $task_category = isset($_POST['task_category']) ? $_POST['task_category'] : '';
    $task_priority = isset($_POST['task_priority']) ? $_POST['task_priority'] : '';

    // Protection contre les injections SQL
    $task_id = $conn->real_escape_string($task_id);
    $task_title = $conn->real_escape_string($task_title);
    $task_description = $conn->real_escape_string($task_description);
    $task_category = $conn->real_escape_string($task_category);
    $task_priority = $conn->real_escape_string($task_priority);

    $sql = "UPDATE tasks SET title='$task_title', description='$task_description', catégorie_id='$task_category', priority='$task_priority', updated_at=NOW() WHERE id='$task_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Tâche mise à jour avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}


// Supprimer une tâche
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_task'])) {
    $task_id = $_GET['delete_task'];

    $sql = "DELETE FROM tasks WHERE id='$task_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Tâche supprimée avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les données
$sql_tasks = "SELECT COUNT(*) as task_count FROM tasks";
$result_tasks = $conn->query($sql_tasks);
$row_tasks = $result_tasks->fetch_assoc();
$task_count = $row_tasks['task_count'];

$sql_categories = "SELECT COUNT(*) as category_count FROM task_categories";
$result_categories = $conn->query($sql_categories);
$row_categories = $result_categories->fetch_assoc();
$category_count = $row_categories['category_count'];

$sql_users = "SELECT COUNT(*) as user_count FROM users";
$result_users = $conn->query($sql_users);
$row_users = $result_users->fetch_assoc();
$user_count = $row_users['user_count'];

$sql_roles = "SELECT COUNT(*) as role_count FROM user_roles";
$result_roles = $conn->query($sql_roles);
$row_roles = $result_roles->fetch_assoc();
$role_count = $row_roles['role_count'];

$sql_all_tasks = "SELECT * FROM tasks";
$result_all_tasks = $conn->query($sql_all_tasks);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskMaster: Task Manager</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.8.12/tailwind-experimental.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <link rel="stylesheet" href="./css/main.css">
</head>
<body class="bg-purple-600 min-h-screen">
  <div class="fixed bg-white text-blue-800 px-10 py-1 z-10 w-full">
      <div class="flex items-center justify-between py-2 text-5x1">
        <div class="font-bold text-orange-500 text-xl">Task<span class="text-purple-600">Master</span></div>
        <div class="flex items-center text-gray-500">
          <span class="material-icons-outlined p-2" style="font-size: 30px">search</span>
          <span class="material-icons-outlined p-2" style="font-size: 30px">notifications</span>
          <div class="bg-center bg-cover bg-no-repeat rounded-full inline-block h-12 w-12 ml-2" style="background-image: url(https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg)"></div>
        </div>
    </div>
  </div>
  <div class="flex flex-row pt-24 px-10 pb-4">
    <div class="w-2/12 mr-6">
      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="http://localhost/Taskmaster/index.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">dashboard</span>
          Home
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="#" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">tune</span>
          Some menu item
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="http://localhost/Taskmaster/kanbanproject.php" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">file_copy</span>
          Tâches
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>

      <div class="bg-white rounded-xl shadow-lg mb-6 px-6 py-4">
        <a href="" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">face</span>
          Profile
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">settings</span>
          Settings
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
        <a href="" class="inline-block text-gray-600 hover:text-black my-4 w-full">
          <span class="material-icons-outlined float-left pr-2">power_settings_new</span>
          Log out
          <span class="material-icons-outlined float-right">keyboard_arrow_right</span>
        </a>
      </div>
    </div>

    <div class="flex-grow text-gray-800">
        <header class="flex items-center h-20 px-6 sm:px-10 bg-white">
            <!-- Header content -->
        </header>
        <main class="p-6 sm:p-10 space-y-6">
            <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Tâches</h3>
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold"><?= $task_count ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Catégories</h3>
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold"><?= $category_count ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Utilisateurs</h3>
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold"><?= $user_count ?></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">Rôles</h3>
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="text-3xl font-bold"><?= $role_count ?></p>
                    </div>
                </div>
            </section>

            <section class="bg-white p-6 rounded-lg shadow-lg space-y-6">
                <h2 class="text-xl font-bold text-orange-500 mb-4">Liste des tâches</h2>
                <form method="POST" action="" class="space-y-4">
                    <div>
                        <label for="task_title" class="block text-sm font-medium text-gray-700">Titre de la tâche</label>
                        <input type="text" id="task_title" name="task_title" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="task_description" class="block text-sm font-medium text-gray-700">Description de la tâche</label>
                        <textarea id="task_description" name="task_description" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                    <div>
                        <label for="task_category" class="block text-sm font-medium text-gray-700">Catégorie</label>
                        <select id="task_category" name="task_category" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <!-- Options de catégories ici -->
                            <option value="important">informatique</option>
                            <option value="normal">infography</option>
                            <option value="not important">reseau</option>
                        </select>
                    </div>
                    <div>
                        <label for="task_deadline" class="block text-sm font-medium text-gray-700">Date limite</label>
                        <input type="date" id="task_deadline" name="task_deadline" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div>
                        <label for="task_priority" class="block text-sm font-medium text-gray-700">Priorité</label>
                        <select id="task_priority" name="task_priority" required class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            <option value="important">Important</option>
                            <option value="normal">Normal</option>
                            <option value="not important">Pas important</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" name="add_task" class="px-4 py-2 bg-purple-600 text-white rounded-md">Ajouter la tâche</button>
                    </div>
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

                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200">Titre</th>
                            <th class="py-2 px-4 border-b border-gray-200">Description</th>
                            <th class="py-2 px-4 border-b border-gray-200">Catégorie</th>
                            <th class="py-2 px-4 border-b border-gray-200">Date limite</th>
                            <th class="py-2 px-4 border-b border-gray-200">Priorité</th>
                            <th class="py-2 px-4 border-b border-gray-200">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result_all_tasks->fetch_assoc()) { ?>
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200"><?= $row['title'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= $row['description'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= $row['catégorie'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= $row['deadline'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-200"><?= $row['priority'] ?></td>
                            <td class="py-2 px-4 border-b border-gray-200">
                            <form method="POST" action="edit_task.php" class="inline-block">
                                <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
                                <button type="submit" name="edit_task" class="text-blue-600 hover:text-blue-900">Modifier</button>
                            </form>
                                <form method="GET" action="" class="inline-block">
                                    <input type="hidden" name="delete_task" value="<?= $row['id'] ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-900">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
  </div>
</body>
</html>
