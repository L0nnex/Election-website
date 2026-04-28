<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
    
}

require_once "../autoload.php";
use database\database;


if (isset($_GET['quaza_name']) && isset($_GET['image_filename'])) {

    $name = filter_var($_GET['quaza_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $imagename = filter_var($_GET['image_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

        $dbh = new database();
        $pdo = $dbh->getConnection();

        $stmt = $pdo->prepare("INSERT INTO quazas (quaza_name, image_filename) VALUES (:n, :i)");
        $stmt->execute([':n' => $name, ':i' => $imagename]);

        header("Location: dashboard.php");
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Qaza</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="info">
<h1>Add Qaza</h1>


<form method="GET" action="quaza_add.php">
    Name: <input name="quaza_name" required><br><br>
    Image filename: <input name="image_filename" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>
<div>
</body>
</html>