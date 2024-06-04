<?php
header('Content-Type: text/html; charset=utf-8');

$fichier = 'tasks.txt';
$taches = file_get_contents($fichier);

$taches_array = explode("\n", $tasks); 
$csv_data = '';
foreach ($taches_array as $tasks) {
   
    $csv_data .= $tasks . "\n"; 
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="tasks.csv"');

echo $csv_data;
?>
