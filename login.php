<?php
session_start();

// Activer l'affichage des erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Affichage des données pour débogage
    echo "Email: $email, Mot de passe: $password<br>";

    include "config.php";

    // Vérifiez si la connexion à la base de données est réussie
    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    } else {
        echo "Connexion à la base de données réussie.<br>";
    }

    // Préparation de la requête SQL pour vérifier les informations d'identification de l'utilisateur
    $stmt = $conn->prepare("SELECT utilisateurId, utilisateurNom, utilisateurPrenom, password FROM utilisateur WHERE email = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nom, $prenom, $hashed_password);

    // Vérification des résultats de la requête
    
    echo "$stmt->num_rows";
    if ($stmt->num_rows > 0) {
        $stmt->fetch();
        // Affichage des résultats pour débogage
        echo "Utilisateur trouvé: $nom $prenom<br>";

        // Vérification du mot de passe haché
        if (password_verify($password, $hashed_password)) {
            // Informations d'identification correctes, démarrer la session
            session_unset();
            $_SESSION['utilisateurNom'] = $nom;
            $_SESSION['utilisateurPrenom'] = $prenom;
            $_SESSION['utilisateurId'] = $id;
            header('Location: accueil.php');
            exit();
        } else {
            // Mot de passe incorrect
            echo "<script>
alert('Hashed Password: " . addslashes($hashed_password) . "\nPassword: " . addslashes($password) . "');
window.location.href='login.php';
</script>";
            //echo "<script>alert('Mot de passe incorrect.'); window.location.href='login.php';</script>";
        }
    } else {
        // Email non trouvé
        echo "<script>alert('Email non trouvé. Veuillez vous enregistrer.'); window.location.href='register.php';</script>";
    }

    // Fermeture de la requête et de la connexion à la base de données
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="./src/output.css" rel="stylesheet">
  <script src="./js/script.js"></script>
</head>
<body class="bg-gray-300 m-0">
  <div class="absolute inset-0 -mt-16">
    <div class="w-[500px] h-[500px] rounded-full bg-purple-500 absolute right-[100px] bottom-[10px]"></div>
    <div class="w-[300px] h-[300px] rounded-full bg-teal-500 absolute right-[400px] bottom-[10px]"></div>
    <div class="w-[100px] h-[100px] rounded-full bg-yellow-500 absolute left-[500px] top-[10px]"></div>
    <div class="w-[400px] h-[400px] rounded-full bg-red-500 absolute left-[100px] top-[50px]"></div>
  </div>
  
  <div id="login-form" class="font-sans bg-white text-gray-600 w-[600px] rounded shadow-xl mx-auto mt-16 relative">
    <form id="login-form" method="post" action="login.php">
      <div class="p-8 text-center mb-12">
        <h1 class="text-slate-600 font-poppins text-left text-2xl">LOGIN</h1>
        <div class="w-full mt-11 mb-16 font-sans">
          <input type="email" name="email" placeholder="EMAIL" class="block w-full my-8 p-3 border-b border-gray-300 outline-none" required />
          <input type="password" name="password" placeholder="PASSWORD" class="block w-full my-6 p-3 border-b border-gray-300 outline-none" required />
        </div>
      </div>
      <div class="flex">
        <button type="button" id="register-button" class="w-1/2 p-5 bg-gray-300 text-left rounded-bl cursor-pointer hover:bg-gray-400" onclick="window.location.href='register.php'">REGISTER</button>
        <input type="submit" value="SIGN IN" class="w-1/2 p-5 bg-blue-900 text-white text-right rounded-br cursor-pointer hover:bg-blue-700" />
      </div>
    </form>
  </div>
</body>
</html>
