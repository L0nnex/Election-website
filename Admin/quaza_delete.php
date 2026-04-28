<?php
session_start();

if (!isset($_SESSION['admin'])) {
    $_SESSION['error_message'] = "Please log in first.";
    header("Location: index.php");
}

require_once "../autoload.php";
use database\database;

$quaza_id = (int)$_GET['id'];

$db = new database();
$pdo = $db->getConnection();


$stmt = $pdo->prepare("SELECT list_id FROM lists WHERE quaza_id = :id");
$stmt->execute([':id' => $quaza_id]);
$list_ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

foreach ($list_ids as $list_id) {

    $delCandidates = $pdo->prepare("DELETE FROM candidates WHERE list_id = :lid");
    $delCandidates->execute([':lid' => $list_id]);

}

$del_lists = $pdo->prepare("DELETE FROM lists WHERE quaza_id = :id");
$del_lists->execute([':id' => $quaza_id]);

$del_qaza = $pdo->prepare("DELETE FROM quazas WHERE quaza_id = :id");
$del_qaza->execute([':id' => $quaza_id]);


header("Location: dashboard.php");

?>
