<?php
session_start();

$error = $_SESSION['error_message']??"";
unset($_SESSION['error_message']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
     <link rel="stylesheet" href="style.css">
</style>



</head>
<body>
<div class="info">
<h2>Admin Login</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post" action="login.php">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>
</div>

</body>
</html>