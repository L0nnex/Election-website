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

$stmt = $pdo->prepare("SELECT * FROM quazas WHERE quaza_id = :id");
$stmt->execute([':id' => $quaza_id]);
$selected_quaza = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['quaza_name']) && isset($_GET['image_filename'])) {

    $name  = filter_var($_GET['quaza_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $image = filter_var($_GET['image_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update = $pdo->prepare("UPDATE quazas SET quaza_name = :name, image_filename = :img WHERE quaza_id = :id");
    $update->execute([':name' => $name, ':img' => $image, ':id' => $quaza_id]);

    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Qaza</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="info">
<h1>Edit Qaza <?php print($selected_quaza['quaza_name']) ?> :</h1>

<form method="GET" action="quaza_edit.php">

    <input type="hidden" name="id" value="<?php print($quaza_id) ?>">

    Name:
    <input name="quaza_name" value="<?php print($selected_quaza['quaza_name']); ?>" required><br><br>

    Image filename:
    <input name="image_filename" value="<?php print($selected_quaza['image_filename']); ?>" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>
</div>
</body>
</html>


