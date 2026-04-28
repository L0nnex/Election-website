<?php
session_start();

require_once "../autoload.php";


$username = filter_var($_POST['username'],FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);

$dbh = new \database\database();
$pdo=$dbh->getConnection();

$stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username = :u");
$stmt->execute([':u' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user['username']==$username && $user['password_sha1'] == sha1($password)) {

    $_SESSION['admin'] = $user['username'];
    header("Location: dashboard.php");
    

} else {

    
    $_SESSION['error_message'] = "Wrong username or password.";
    header("Location: index.php");
}
?>
