<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<h1>Admin panel</h1>

<a href="nasa-praca.php">Naša práca – správa fotiek</a><br><br>
<a href="logout.php">Odhlásiť</a>
