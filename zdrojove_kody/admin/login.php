<?php
session_start();

if (isset($_SESSION['admin'])) {
    header("Location: nasa-praca.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $meno = $_POST['meno'];
    $heslo = $_POST['heslo'];

    if ($meno === "admin" && $heslo === "pekraAdmin2026") {
        $_SESSION['admin'] = true;
        header("Location: nasa-praca.php");
        exit();
    } else {
        $chyba = "Nesprávne prihlasovacie údaje";
    }
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../style.css">
    <title>Admin prihlásenie</title>
</head>
<body>

<section class="admin-login">
<h2>Prihlásenie do admin sekcie</h2>

<form method="post">
    <input type="text" name="meno" placeholder="Meno" required><br><br>
    <input type="password" name="heslo" placeholder="Heslo" required><br><br>
    <button type="submit">Prihlásiť</button>
</form>

<p style="color:red;">
    <?= $chyba ?? '' ?>
</p>
</section>

</body>
</html>
