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

$delCandidates = $pdo->prepare("DELETE FROM candidates WHERE list_id = :lid");
$delCandidates->execute([':lid' => $list_id]);


$delList = $pdo->prepare("DELETE FROM lists WHERE list_id = :id");
$delList->execute([':id' => $list_id]);

header("Location: dashboard.php");


?>