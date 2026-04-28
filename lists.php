<?php

require_once('./autoload.php');   

$listid = (int)$_GET['id'];

$db = new \database\database();
$pdo = $db->getConnection();

$stmt = $pdo->prepare("SELECT * FROM lists WHERE list_id = :id");
$stmt->execute([':id' => $listid]);

$selected_list = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head> 
	<title><?php print($selected_list['list_name'])?> Candidates</title>
	<meta charset="utf-8"/>
 </head>
 <body>
 <div>
    <h1><?php print($selected_list['list_name'])?> Candidates: </h1><br>

   <?php $stmt = $pdo->prepare("SELECT * FROM candidates WHERE list_id = :id");
         $stmt->execute([':id' => $listid]);

         $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

         foreach($data as $entry){
print<<<HTHT

   <img src="./Photos/{$entry['photo_filename']}" alt="{$entry['candidate_name']}"> 
   {$entry['candidate_name']}
   {$entry['Date_Of_Birth']}
   {$entry['sect']}
   <br>
   
 HTHT;
 }
 ?>
</div>
</body>
</html>