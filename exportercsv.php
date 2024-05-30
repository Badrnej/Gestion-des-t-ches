<?php
header('Content-Type: text/html; charset=utf-8');

$fichier = 'taches.txt';
$taches = file_get_contents($fichier);

$taches_array = explode("\n", $taches); 
$csv_data = '';
foreach ($taches_array as $tache) {
   
    $csv_data .= $tache . "\n"; 
}

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="taches.csv"');

echo $csv_data;
?>
