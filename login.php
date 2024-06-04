<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include "config.php";

    if ($conn->connect_error) {
        die("Erreur de connexion: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT utilisateurId, utilisateurNom, utilisateurPrenom, password FROM utilisateur WHERE email = ?");
    if (!$stmt) {
        die("Erreur de préparation de la requête: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nom, $prenom, $hashed_password);

    if ($stmt->num_rows > 0) {
      $stmt->fetch();
  
      // Debugging: Output hashed password from database and hashed user input password
      echo "Hashed Password from DB: $hashed_password<br>";
      echo "Hashed Password from Input: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";
  
      if (password_verify($password, $hashed_password)) {
          // Correct password
          session_unset();
          $_SESSION['utilisateurNom'] = $nom;
          $_SESSION['utilisateurPrenom'] = $prenom;
          $_SESSION['utilisateurId'] = $id;
          header('Location: accueil.php');
          exit();
      } else {
          // Incorrect password
          echo "<script>alert('Mot de passe incorrect.'); window.location.href='login.php';</script>";
      }
  }
  
?>
