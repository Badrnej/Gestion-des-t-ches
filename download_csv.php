<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "taskmaster";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM tasks");
    $stmt->execute();

    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($tasks)) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename=tasks.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('ID', 'Title', 'Description', 'Category', 'Deadline', 'Priority', 'List'));

        foreach ($tasks as $task) {
            fputcsv($output, $task);
        }

        fclose($output);
        exit();
    } else {
        echo "No data found.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
