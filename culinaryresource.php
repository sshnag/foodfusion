<?php 
include 'db/connection.php';
include 'elements/navigation.php';

$query= "SELECT * FROM resources WHERE type= 'culinary' AND is_delted=0 ORDER BY uploaded_at DESC";
$result= $connection->query($query);
?>