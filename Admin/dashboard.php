<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;


$dbh = new database();
$pdo = $dbh->getConnection();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Welcome, <?php print($_SESSION['admin']); ?></h1>

<a href="admin_logout.php"><button>Logout</button></a>

<h2>Manage Qazas</h2>
<a href="quaza_add.php"><button>Add New Qaza</button></a><br><br>
<hr>


<?php
$stmt=$pdo->prepare("SELECT * From quazas");
$stmt->execute();

 $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

 foreach($data as $entry){ 

 print<<<HTHT
 
 <div class="quaza_div">

 <h3>Quaza:</h3>
   <img height="100" width="200" src="../Images/{$entry['image_filename'] }" alt="{$entry['quaza_name']}">
  
   {$entry['quaza_name']}: 
   <a href="quaza_edit.php?id={$entry['quaza_id']}"> <button> Edit Quaza </button> </a>
   <a href="quaza_delete.php?id={$entry['quaza_id']}"> <button> Delete Quaza </button> </a>
   <a href="list_add.php?id={$entry['quaza_id']}"> <button> Add New List </button> </a>
 </div>  
   
 HTHT;

    $stmt2 = $pdo->prepare("SELECT * FROM lists WHERE quaza_id = :id");
    $stmt2->execute([':id' => $entry['quaza_id']]);
    $lists = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    print("<h3>Lists:</h3>");
    foreach ($lists as $list) {

        print <<<HTHT
        <div>
            <img height="100" width="200" src="../Logos/{$list['logo_filename']}" alt="{$list['list_name']}"> {$list['list_name']}
            <a href="list_edit.php?id={$list['list_id']}"><button>Edit List</button></a>
            <a href="list_delete.php?id={$list['list_id']}"><button>Delete List</button></a>
            <a href="list_view.php?id={$list['list_id']}"><button>View Candidates</button></a>
        </div>
        HTHT;
    }

    print "<hr>";
 }
 ?>

</body>
</html>
