<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;

$list_id = (int)$_GET['list_id'];


$dbh = new database();
$pdo = $dbh->getConnection();

$stmt = $pdo->prepare("SELECT list_name FROM lists WHERE list_id = :id");
$stmt->execute([':id' => $list_id]);
$list = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['candidate_name']) && isset($_GET['Date_Of_Birth']) && isset($_GET['sect']) && isset($_GET['photo_filename'])) {

    $name  = filter_var($_GET['candidate_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dob   = filter_var($_GET['Date_Of_Birth'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sect  = filter_var($_GET['sect'], FILTER_SANITIZE_SPECIAL_CHARS);
    $photo = filter_var($_GET['photo_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

   

        $insert = $pdo->prepare("
            INSERT INTO candidates (candidate_name, Date_Of_Birth, sect, list_id, photo_filename)
            VALUES (:n, :d, :s, :lid, :p)
        ");
        $insert->execute([
            ':n'   => $name,
            ':d'   => $dob,
            ':s'   => $sect,
            ':lid' => $list_id,
            ':p'   => $photo
        ]);

        header("Location: list_view.php?id=" . $list_id);
       
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Candidate</title>
    <meta charset="utf-8">
     <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="info">
<h1>Add Candidate to List: <?php print($list['list_name']) ?></h1>

<form method="GET" action="candidate_add.php">

    <input type="hidden" name="list_id" value="<?= $list_id ?>">

    Candidate Name:
    <input name="candidate_name" required><br><br>

    Date of Birth:
    <input name="Date_Of_Birth" placeholder="YYYY-MM-DD" required><br><br>

    Sect:
    <input name="sect" required><br><br>

    Photo Filename:
    <input name="photo_filename" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='list_view.php?id=<?= $list_id ?>'">Cancel</button>

</form>
</div>

</body>
</html>
