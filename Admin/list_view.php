<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;

$list_id = (int)$_GET['id'];

$dbh = new database();
$pdo = $dbh->getConnection();

$stmt = $pdo->prepare("SELECT * FROM lists WHERE list_id = :id");
$stmt->execute([':id' => $list_id]);

$list = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $pdo->prepare("SELECT * FROM candidates WHERE list_id = :id");
$stmt2->execute([':id' => $list_id]);

$candidates = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>List: <?php print($list['list_name'])?></h1>

<img src="../Logos/<?php print($list['logo_filename']) ?>" width="200">

<br><br>

<a href="candidate_add.php?list_id=<?php print($list_id)?>">
    <button>Add New Candidate</button>
</a>

<hr>

<h2>Candidates in this list:</h2>

<?php
foreach ($candidates as $cand) {

    print <<<HTHT
    <div>
        <img src="../Photos/{$cand['photo_filename']}" alt="{$cand['candidate_name']}"> 
   {$cand['candidate_name']}
   {$cand['Date_Of_Birth']}
   {$cand['sect']}
   <br>

        <a href="candidate_edit.php?id={$cand['candidate_id']}"><button>Edit Candidate</button></a>
        <a href="candidate_delete.php?id={$cand['candidate_id']}"><button>Delete Candidate</button></a>

        <hr>
    </div>
HTHT;

}
?>

<button onclick="location.href='dashboard.php'">Back to Dashboard</button>

</body>
</html>