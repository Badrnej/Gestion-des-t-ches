<?php
include 'config.php';

// Suppression de l'utilisateur
if (isset($_GET['delete'])) {
    $userId = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :id");
    $stmt->execute([':id' => $userId]);
    header("Location: gérer_les_utilisateurs.php");
}

// Modification du rôle de l'utilisateur
if (isset($_POST['update_role'])) {
    $userId = $_POST['user_id'];
    $newRole = $_POST['role'];
    $stmt = $conn->prepare("UPDATE users SET role = :role WHERE id = :id");
    $stmt->execute([':role' => $newRole, ':id' => $userId]);
    header("Location: gérer_les_utilisateurs.php");
}

// Récupération des utilisateurs
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gérer les Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-purple-600 p-8">

    <div class="container mx-auto">
        <a href="dashboard.php" class="bg-gray-500 text-white rounded-lg py-2 px-4 mb-6 inline-block">Retour au Dashboard</a>
        <h1 class="text-3xl text-yellow-500 font-bold mb-6">Gérer les Utilisateurs</h1>
        <table class="min-w-full bg-purple-300 rounded-lg shadow-md">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase rounded-lg text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">nom</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Rôle</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($users as $user): ?>
                    <tr class="border-b border-gray-200 hover:bg-yellow-500">
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?php echo htmlspecialchars($user['id']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['username']); ?></td>
                        <td class="py-3 px-6 text-left"><?php echo htmlspecialchars($user['email']); ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="POST" action="gérer_les_utilisateurs.php">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                <select name="role" class="bg-gray-200 text-gray-600 border border-gray-300 rounded-lg py-2 px-3">
                                    <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                    <option value="user" <?php echo $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                </select>
                                <button type="submit" name="update_role" class="bg-blue-500 text-white rounded-lg py-2 px-4 ml-2">Modifier</button>
                            </form>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <a href="gérer_les_utilisateurs.php?delete=<?php echo htmlspecialchars($user['id']); ?>" class="bg-red-500 text-white rounded-lg py-2 px-4">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
