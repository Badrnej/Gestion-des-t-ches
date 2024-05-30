<?php 
try{
    $bddPDO = new PDO('mysql:host=localhost;dbname=taskmaster','root','');
}
catch (PDOExcepton $e){
    echo "<p>Erreur:".$e->getMessage();
    die() ;
}
?>