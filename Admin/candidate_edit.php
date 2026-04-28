<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;

$candidate_id = (int)$_GET['id'];


$dbh = new database();
$pdo = $dbh->getConnection();

$stmt = $pdo->prepare("SELECT * FROM candidates WHERE candidate_id = :id");
$stmt->execute([':id' => $candidate_id]);
$candidate = $stmt->fetch(PDO::FETCH_ASSOC);

$list_id = $candidate['list_id'];

if (isset($_GET['candidate_name']) && isset($_GET['Date_Of_Birth']) &&
    isset($_GET['sect']) && isset($_GET['photo_filename'])) {

    $name  = filter_var($_GET['candidate_name'], FILTER_SANITIZE_SPECIAL_CHARS);
    $dob   = filter_var($_GET['Date_Of_Birth'], FILTER_SANITIZE_SPECIAL_CHARS);
    $sect  = filter_var($_GET['sect'], FILTER_SANITIZE_SPECIAL_CHARS);
    $photo = filter_var($_GET['photo_filename'], FILTER_SANITIZE_SPECIAL_CHARS);

    $update = $pdo->prepare("
        UPDATE candidates
        SET candidate_name = :n, Date_Of_Birth = :dob, sect = :sect, photo_filename = :photo
        WHERE candidate_id = :id
    ");

    $update->execute([
        ':n'    => $name,
        ':dob'  => $dob,
        ':sect' => $sect,
        ':photo'=> $photo,
        ':id'   => $candidate_id
    ]);

    header("Location: list_view.php?id=" . $list_id);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Candidate</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="info">
<h1>Edit Candidate: <?php print($candidate['candidate_name']) ?></h1>

<form method="GET" action="candidate_edit.php">

    <input type="hidden" name="id" value="<?php print($candidate_id); ?>">

    Name:
    <input name="candidate_name" value="<?php print($candidate['candidate_name']); ?>" required><br><br>

    Date of Birth:
    <input name="Date_Of_Birth" value="<?php print($candidate['Date_Of_Birth']); ?>" required><br><br>'Date_Of_Birth'

    Sect:
    <input name="sect" value="<?php print($candidate['sect']); ?>" required><br><br>

    Photo Filename:
    <input name="photo_filename" value="<?php print($candidate['photo_filename']); ?>" placeholder="example.png"><br><br>

    <button type="submit">Save</button>
    <button type="button" onclick="location.href='list_view.php?id=<?= $list_id ?>

</form>
</div>
</body>
</html>
