<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TaskMaster: Task Manager</title>
  <link href="./src/output.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/main.css"/>
</head>
<body>
  <!-- Navbar -->
  <nav class="relative container mx-auto p-6">
    <!-- Flex container -->
    <div class="flex items-center justify-between">
      <!-- Logo -->
      <div class="font-bold text-orange-500 text-xl">Task<span class="text-purple-600">Master</span></div>
      <!-- Menu Items -->
      <div class="hidden space-x-6 md:flex">
        <a href="#" class="hover:text-purple-800">Features</a>
        <a href="#" class="hover:text-purple-800">Solutions</a>
        <a href="#" class="hover:text-purple-800">Plans</a>
        <a href="http://localhost/TaskMaster/dashboard.php" class="hover:text-purple-800">Dashboard</a>
        <a href="#" class="hover:text-purple-800">Resources</a>
      </div>
      <!-- Button -->
      <div class="flex space-x-4">
        <a href="logout.php" class="hidden px-5 py-2 pt-1 text-white rounded-full bg-purple-500 hover:bg-purple-600 md:block">Logout</a>
      </div>
      <!-- Hamburger Icon -->
      <button id="menu-btn" class="block hamburger md:hidden focus:outline-none">
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
      </button>
    </div>
    <!-- Mobile Menu -->
    <div class="md:hidden">
      <div id="menu" class="absolute flex-col items-center self-end hidden py-8 mt-10 space-y-6 font-bold bg-white sm:w-auto sm:self-center left-6 right-6 drop-shadow-md">
        <a href="#" class="hover:text-purple-800">Features</a>
        <a href="#" class="hover:text-purple-800">Solutions</a>
        <a href="#" class="hover:text-purple-800">Plans</a>
        <a href="#" class="hover:text-purple-800">Pricing</a>
        <a href="#" class="hover:text-purple-800">Resources</a>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section id="hero">
    <div class="container flex flex-col-reverse items-center px-6 mx-auto mt-10 space-y-0 gap-4 md:flex-row md:space-y-0 md:gap-0">
      <!-- Left Item -->
      <div class="flex flex-col mb-32 space-y-12 md:w-1/2">
        <h1 class="max-w-md text-4xl font-bold text-center md:text-5xl md:text-left">
          Télécharger le fichier CSV
        </h1>
        <p class="max-w-sm text-center text-gray-600 md:text-left">
          Cliquez sur ce bouton pour télécharger le fichier CSV contenant les données du tableau des tâches. Ce fichier permet une gestion efficace et une analyse rapide des tâches. Assurez-vous d'avoir un lecteur CSV installé pour ouvrir le fichier correctement.
        </p>
        <div class="flex justify-center md:justify-start">
        <a href="download_csv.php" class="px-5 py-2 pt-1 text-white rounded-full bg-purple-500 hover:bg-purple-600">Exporter CSV</a>
        </div>
      </div>
      <!-- Image -->
      <div class="md:w-1/2">
        <img src="https://img.freepik.com/free-photo/hand-holding-writing-checklist-application-form-document-clipboard-white-background-3d-illustration_56104-1551.jpg?t=st=1684065531~exp=1684066131~hmac=a91918bd9a656669129b7b7bbb9caf44f4d00e70d0057544f51bd4fe3efe5aed" alt="hero"/>
      </div>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features">
    <div class="container flex flex-col px-4 mx-auto mt-10 space-y-12 md:space-y-0 md:flex-row">
      <!-- Left Side -->
      <div class="flex flex-col space-y-12 md:w-1/2">
        <h2 class="text-4xl max-w-md font-bold text-center md:text-left">
          What's different about TaskMaster?
        </h2>
        <p class="max-w-sm text-center text-gray-600 md:text-left">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Commodi ad minima ullam accusamus voluptate mollitia laudantium aliquid libero est nihil.
        </p>
      </div>
      <!-- Right Side List -->
      <div class="flex flex-col space-y-8 md:w-1/2">
        <!-- List Item 1-->
        <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
          <div class="rounded-l-full bg-purple-100 md:bg-transparent">
            <div class="flex items-center space-x-2">
              <div class="px-4 py-2 text-white rounded-full md:py-1 bg-purple-500">01</div>
              <h3 class="text-base font-bold md:mb-4 md:hidden">Track company-wide progress</h3>
            </div>
          </div>
          <div class="">
            <h3 class="hidden mb-4 text-lg font-bold md:block">Track company-wide progress</h3>
            <p class="text-gray-600 text-sm">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quas beatae dolorem accusantium enim laudantium doloribus tempore alias numquam et! Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, quaerat.
            </p>
          </div>
        </div>
        <!-- List Item 2-->
        <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
          <div class="rounded-l-full bg-purple-100 md:bg-transparent">
            <div class="flex items-center space-x-2">
              <div class="px-4 py-2 text-white rounded-full md:py-1 bg-purple-500">02</div>
              <h3 class="text-base font-bold md:mb-4 md:hidden">Advanced built-in reports</h3>
            </div>
          </div>
          <div class="">
            <h3 class="hidden mb-4 text-lg font-bold md:block">Advanced built-in reports</h3>
            <p class="text-gray-600 text-sm">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quas beatae dolorem accusantium enim laudantium doloribus tempore alias numquam et! Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, quaerat.
            </p>
          </div>
        </div>
        <!-- List Item 3-->
        <div class="flex flex-col space-y-3 md:space-y-0 md:space-x-6 md:flex-row">
          <div class="rounded-l-full bg-purple-100 md:bg-transparent">
            <div class="flex items-center space-x-2">
              <div class="px-4 py-2 text-white rounded-full md:py-1 bg-purple-500">03</div>
              <h3 class="text-base font-bold md:mb-4 md:hidden">Everything you need in one place</h3>
            </div>
          </div>
          <div class="">
            <h3 class="hidden mb-4 text-lg font-bold md:block">Everything you need in one place</h3>
            <p class="text-gray-600 text-sm">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quas beatae dolorem accusantium enim laudantium doloribus tempore alias numquam et! Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, quaerat.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials">
    <div class="max-w-6xl px-5 mx-auto mt-32 text-center">
      <!-- Heading -->
      <h2 class="text-4xl font-bold text-center">What's Different About TaskMaster?</h2>
      <!-- Testimonials Container-->
      <div class="flex flex-col mt-24 md:flex-row md:space-x-6">
        <!-- Testimonial 1 -->
        <div class="flex flex-col items-center p-6 space-y-6 rounded-lg bg-gray-100 md:w-1/3">
          <img src="https://images.pexels.com/photos/2380794/pexels-photo-2380794.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="man" class="w-16 -mt-14 rounded-full"/>
          <h5 class="text-lg font-bold">Badr nejaa</h5>
          <p class="text-sm text-gray-600">
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam beatae repellat reprehenderit provident commodi!"
          </p>
        </div>
        <!-- Testimonial 2 -->
        <div class="hidden flex-col items-center p-6 space-y-6 rounded-lg bg-gray-100 md:flex md:w-1/3">
          <img src="https://images.pexels.com/photos/2380794/pexels-photo-2380794.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="man" class="w-16 -mt-14 rounded-full"/>
          <h5 class="text-lg font-bold">Badr nejaa</h5>
          <p class="text-sm text-gray-600">
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam beatae repellat reprehenderit provident commodi!"
          </p>
        </div>
        <!-- Testimonial 3 -->
        <div class="hidden flex-col items-center p-6 space-y-6 rounded-lg bg-gray-100 md:flex md:w-1/3">
          <img src="https://images.pexels.com/photos/2380794/pexels-photo-2380794.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="man" class="w-16 -mt-14 rounded-full"/>
          <h5 class="text-lg font-bold">Badr nejaa</h5>
          <p class="text-sm text-gray-600">
            "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam beatae repellat reprehenderit provident commodi!"
          </p>
        </div>
      </div>
      <!-- Button -->
      <div class="my-16">
        <a href="#" class="p-3 px-6 pt-2 text-white bg-purple-500 rounded-full baseline hover:bg-purple-600">Get Started</a>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section id="cta" class="bg-purple-500">
    <div class="container flex flex-col items-center justify-between px-6 py-24 mx-auto space-y-12 md:py-12 md:flex-row md:space-y-0">
      <h2 class="text-5xl font-bold leading-tight text-center text-white md:text-4xl md:max-w-xl md:text-left">
        Simplify how your team works today
      </h2>
      <div>
        <a href="#" class="p-3 px-6 pt-2 text-purple-500 bg-white rounded-full shadow-2xl baseline hover:bg-gray-300">Get Started</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800">
    <div class="container flex flex-col-reverse justify-between px-6 py-10 mx-auto space-y-8 md:flex-row md:space-y-0">
      <!-- Logo and Social Links Container -->
      <div class="flex flex-col-reverse items-center justify-between space-y-12 md:flex-col md:space-y-0 md:items-start">
        <div class="mx-auto my-6 text-center text-white md:hidden">Copyright &copy; 2024, All Rights Reserved</div>
        <div>
          <div class="font-bold text-orange-500 text-xl">Task<span class="text-purple-600">Master</span></div>
        </div>
        <!-- Social Icons -->
        <div class="flex justify-center space-x-4">
          <a href="#">
            <img src="https://freesvg.org/img/1534129544.png" alt="facebook" class="h-8"/>
          </a>
          <a href="#">
            <img src="https://freesvg.org/img/1534129544.png" alt="twitter" class="h-8"/>
          </a>
          <a href="#">
            <img src="https://freesvg.org/img/1534129544.png" alt="instagram" class="h-8"/>
          </a>
          <a href="#">
            <img src="https://freesvg.org/img/1534129544.png" alt="linkedin" class="h-8"/>
          </a>
        </div>
      </div>
      <!-- List Container -->
      <div class="flex justify-around space-x-32">
        <div class="flex flex-col space-y-3 text-white">
          <a href="#" class="hover:text-purple-400">Home</a>
          <a href="#" class="hover:text-purple-400">Pricing</a>
          <a href="#" class="hover:text-purple-400">Products</a>
          <a href="#" class="hover:text-purple-400">About</a>
        </div>
        <div class="flex flex-col space-y-3 text-white">
          <a href="#" class="hover:text-purple-400">Careers</a>
          <a href="#" class="hover:text-purple-400">Community</a>
          <a href="#" class="hover:text-purple-400">Privacy Policy</a>
        </div>
      </div>
      <div class="hidden text-white md:block">Copyright &copy; 2024, All Rights Reserved</div>
    </div>
  </footer>

  <script src="./js/main.js"></script>
</body>
</html>
