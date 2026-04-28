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
$selected_list = $stmt->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['list_name']) && isset($_GET['logo_filename'])) {

    $name  = filter_var($_GET['list_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $logo  = filter_var($_GET['logo_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update = $pdo->prepare("UPDATE lists SET list_name = :name, logo_filename = :logo WHERE list_id = :id");
    $update->execute([
        ':name' => $name,
        ':logo' => $logo,
        ':id'   => $list_id
    ]);

    header("Location: dashboard.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="info">
<h1>Edit List: <?php print($selected_list['list_name']); ?></h1>


<form method="GET" action="list_edit.php">

    <input type="hidden" name="id" value="<?php print($list_id); ?>">

    List Name:
    <input name="list_name" value="<?php print($selected_list['list_name']); ?>" required><br><br>

    Logo Filename:
    <input name="logo_filename" value="<?php print($selected_list['logo_filename']); ?>" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='dashboard.php'">Cancel</button>
</form>
</div>

</body>
</html>
