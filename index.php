<!DOCTYPE html>
<html>
<head> 
	<title>LEBANON QUAZAS</title>
	<meta charset="utf-8"/>
 </head>
 <body>
 <div>
    <h1>LEBANON Quazas: </h1><br>
 
 <?php 
 
 require_once('./autoload.php');

 $db = new \database\database();
 $pdo = $db->getConnection();

 $stmt=$pdo->prepare("SELECT * From quazas");
 $stmt->execute();

 $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

 foreach($data as $entry){ 
 print<<<HTHT
 <a href="quazas.php?id={$entry['quaza_id']}">
   <img src="./Images/{$entry['image_filename']}" alt="{$entry['quaza_name']}">
   {$entry['quaza_name']}
 </a><br>  
 HTHT;
 }
 ?>
</div>
</body>
</html>
