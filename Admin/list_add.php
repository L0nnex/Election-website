<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;

$quaza_id = (int)$_GET['id'];

$dbh = new database();
$pdo = $dbh->getConnection();

$stmt = $pdo->prepare("SELECT quaza_name FROM quazas WHERE quaza_id = :id");
$stmt->execute([':id' => $quaza_id]);
$qaza = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['list_name']) && isset($_GET['logo_filename'])) {

    $name = filter_var($_GET['list_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $logo = filter_var($_GET['logo_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

   
        $insert = $pdo->prepare("INSERT INTO lists (list_name, quaza_id, logo_filename) 
                                 VALUES (:name, :qid, :logo)");
        $insert->execute([
            ':name' => $name,
            ':qid'  => $quaza_id,
            ':logo' => $logo
        ]);

        header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add List</title>
    <meta charset="utf-8">
     <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="info">
<h1>Add New List to <?= htmlspecialchars($qaza['quaza_name']) ?></h1>

<form method="GET" action="list_add.php">

    <input type="hidden" name="id" value="<?php print($quaza_id) ?>">

    List Name:
    <input name="list_name" required><br><br>

    Logo Filename:
    <input name="logo_filename" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='dashboard.php'">Cancel</button>

</form>
</div>

</body>
</html>
