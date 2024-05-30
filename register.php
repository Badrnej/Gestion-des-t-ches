<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if ($password === $confirm_password) {
       
        include "config.php";

        

       
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO utilisateur (utilisateurNom, utilisateurPrenom, email, password) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nom, $prenom, $email, $password);
// Exécutez la requête d'insertion ici


        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="./src/output.css" rel="stylesheet">
  <script src="./js/registerscript.js" defer></script>
</head>
<body class="bg-gray-300 m-0">
  <div class="absolute inset-0 -mt-16">
    <div class="w-[500px] h-[500px] rounded-full bg-purple-500 absolute right-[100px] bottom-[10px]"></div>
    <div class="w-[300px] h-[300px] rounded-full bg-teal-500 absolute right-[400px] bottom-[10px]"></div>
    <div class="w-[100px] h-[100px] rounded-full bg-yellow-500 absolute left-[500px] top-[10px]"></div>
    <div class="w-[400px] h-[400px] rounded-full bg-red-500 absolute left-[100px] top-[50px]"></div>
  </div>
  <!-- Formulaire d'inscription -->
  <div id="register-form" class="font-sans bg-white text-gray-600 w-[600px] rounded shadow-xl mx-auto mt-16 relative ">
    <form id="registration-form" method="post" action="register.php">
      <div class="p-8 text-center mb-12">
        <h1 class="text-slate-600 font-poppins text-left text-2xl">REGISTER</h1>
        <div class="w-full mt-11 mb-16 font-sans">
          <input type="text" name="nom" id="register-nom" placeholder="NOM" class="block w-full my-4 p-3 border-b border-gray-300 outline-none" required />
          <input type="text" name="prenom" id="register-prenom" placeholder="PRENOM" class="block w-full my-4 p-3 border-b border-gray-300 outline-none" required />
          <input type="email" name="email" id="register-email" placeholder="EMAIL" class="block w-full my-4 p-3 border-b border-gray-300 outline-none" required />
          <input type="password" name="password" id="register-password" placeholder="MOT DE PASSE" class="block w-full my-4 p-3 border-b border-gray-300 outline-none" required />
          <input type="password" name="confirm_password" id="register-confirm-password" placeholder="CONFIRMER MOT DE PASSE" class="block w-full my-4 p-3 border-b border-gray-300 outline-none" required />
        </div>
      </div>
      <div class="flex">
        <button type="button" id="back-to-login-button" class="w-1/2 p-5 bg-gray-300 text-left rounded-bl cursor-pointer hover:bg-gray-400">SIGN IN</button>
        <input type="submit" value="REGISTER" class="w-1/2 p-5 bg-blue-900 text-white text-right rounded-br cursor-pointer hover:bg-blue-700" />
        <span id="password-error" class="text-red-500"></span>
      </div>
    </form>
  </div>
  
</body>
</html>
