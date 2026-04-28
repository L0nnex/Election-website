<?php

require_once('./autoload.php');   

$quazaid = (int)$_GET['id'];

$db = new \database\database();
$pdo = $db->getConnection();

$stmt = $pdo->prepare("SELECT * FROM quazas WHERE quaza_id = :id");
$stmt->execute([':id' => $quazaid]);

$selected_quaza = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head> 
	<title><?php print($selected_quaza['quaza_name'])?> Quaza Lists</title>
	<meta charset="utf-8"/>
 </head>
 <body>
 <div>
    <h1><?php print($selected_quaza['quaza_name'])?> Lists: </h1><br>

   <?php $stmt = $pdo->prepare("SELECT * FROM lists WHERE quaza_id = :id");
         $stmt->execute([':id' => $quazaid]);

         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

         foreach($data as $entry){
print<<<HTHT
 <a href="lists.php?id={$entry['list_id']}">
   <img src="./Logos/{$entry['logo_filename']}" alt="{$entry['list_name']}"> {$entry['list_name']}
 </a><br>  
 HTHT;
 }
 ?>
</div>
</body>
</html>