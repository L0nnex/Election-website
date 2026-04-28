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

$stmt = $pdo->prepare("SELECT list_id FROM candidates WHERE candidate_id = :id");
$stmt->execute([':id' => $candidate_id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$list_id = $row['list_id'];

$del = $pdo->prepare("DELETE FROM candidates WHERE candidate_id = :id");
$del->execute([':id' => $candidate_id]);

header("Location: list_view.php?id=" . $list_id);

?>
