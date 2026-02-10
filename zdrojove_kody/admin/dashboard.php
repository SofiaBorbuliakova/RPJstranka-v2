<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body class="admin-panel">

<h1 style="text-align:center;">Admin panel</h1>

<div class="admin-menu">
    <a href="nasa-praca.php">Naša práca – správa fotiek</a>
    <a href="logout.php" class="logout">Odhlásiť</a>
</div>


</body>
</html>
