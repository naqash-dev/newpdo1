<?php
try{
$conn = new pdo("mysql:host=localhost;dbname=pdologin","root","");
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
echo("ERROR: " . $e->getMessage());
}
?>