<?php

require './autoload.php';

$db = new \database\database();
$pdo = $db->getConnection();

$csv = fopen("./seeder.csv", "r");

$quazaStmt = $pdo->prepare("INSERT INTO quazas (quaza_id, quaza_name, image_filename) VALUES (:quaza_id,:quaza_name,:image_filename) 
                            ON DUPLICATE KEY UPDATE
                            quaza_name = VALUES(quaza_name), 
                            image_filename = VALUES(image_filename)");

$listStmt = $pdo->prepare(" INSERT INTO lists (list_id, list_name, quaza_id, logo_filename) VALUES (:list_id,:list_name,:quaza_id,:logo_filename)
                            ON DUPLICATE KEY UPDATE
                            list_name = VALUES(list_name),
                            quaza_id = VALUES(quaza_id),
                            logo_filename = VALUES(logo_filename)");

$candStmt = $pdo->prepare("INSERT INTO candidates (candidate_id, candidate_name, Date_Of_Birth, sect, list_id, photo_filename) VALUES (:candidate_id,:candidate_name,:Date_Of_Birth,:sect,:list_id,:photo_filename) 
                           ON DUPLICATE KEY UPDATE
                           candidate_name = VALUES(candidate_name),
                           Date_Of_Birth = VALUES(Date_Of_Birth),
                           sect = VALUES(sect),
                           list_id = VALUES(list_id),
                           photo_filename = VALUES(photo_filename)
");

while(!feof($csv)){


$row=fgets($csv);
$row=explode(',',$row);

if($row[0]==0){
    continue;
}

$quazaStmt->execute([
    ':quaza_id' => $row[0],          
    ':quaza_name' => $row[1],       
    ':image_filename' => $row[2] 
]);

$listStmt->execute([
    ':list_id' => $row[3],            
    ':list_name' => $row[4],         
    ':quaza_id' => $row[5],           
    ':logo_filename' => $row[6] 
]);

$candStmt->execute([
    ':candidate_id' => $row[7],       
    ':candidate_name' => $row[8],   
    ':Date_Of_Birth' => $row[9],              
    ':sect' => $row[10],                       
    ':list_id' => $row[11],                 
    ':photo_filename' => $row[12]   
]);


}

fclose($csv);
?>