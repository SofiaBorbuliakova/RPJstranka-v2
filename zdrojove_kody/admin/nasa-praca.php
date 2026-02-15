<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// -----------------------
// MAZANIE FOTIEK
// -----------------------
if (isset($_GET['zmaz'])) {
    $cesta = "../obrazky/" . $_GET['zmaz'];

    if (file_exists($cesta)) {
        unlink($cesta);
    }

    header("Location: nasa-praca.php");
    exit();
}

// -----------------------
// UPLOAD FOTIEK
// -----------------------
if (isset($_POST['upload'])) {

    $kategoria = $_POST['kategoria'];
    $ciel = "../obrazky/$kategoria/";

    // pre každú vybranú fotku
    foreach ($_FILES['foto']['tmp_name'] as $key => $tmp_name) {

        $nazov = basename($_FILES['foto']['name'][$key]);
        $typ = strtolower(pathinfo($nazov, PATHINFO_EXTENSION));

        if (in_array($typ, ["jpg", "jpeg", "png"])) {
            move_uploaded_file($tmp_name, $ciel . $nazov);
        }
    }

    header("Location: nasa-praca.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin – Naša práca</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h1 style="text-align: center;">Admin – Naša práca</h1>

<div class="admin-top-menu">
    <a href="logout.php" class="admin-btn logout">Odhlásiť</a>
</div>

<div class="admin-login">
    <h2>Pridať fotografiu</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="foto[]" multiple required>

        <select name="kategoria" required class="admin-select">
            <option value="kuchyne">Kuchyne</option>
            <option value="police">Police</option>
            <option value="skrine">Skrine</option>
            <option value="stoly">Stoly</option>
            <option value="postele">Postele</option>
            <option value="predsien">Predsieň</option>
            <option value="lekarne">Lekárne</option>
        </select>

        <button type="submit" name="upload">Nahrať</button>
    </form>
</div>

<hr>

<h2 style="text-align:center;">Galéria</h2>

<?php
$kategorie = [
    "kuchyne" => "Kuchyne",
    "police" => "Police",
    "skrine" => "Skrine",
    "stoly" => "Stoly",
    "postele" => "Postele",
    "predsien" => "Predsieň",
    "lekarne" => "Lekárne"
];

foreach ($kategorie as $folder => $nazov) {

    echo "<h3 style='text-align:center;'>$nazov</h3>";

    $imgs = glob("../obrazky/$folder/*.{jpg,jpeg,png}", GLOB_BRACE);

    if (empty($imgs)) {
        echo "<p style='text-align:center;'>Žiadne fotografie.</p>";
        continue;
    }

    echo "<div class='admin-galeria'>";

    foreach ($imgs as $img) {
        $nazovSuboru = basename($img);

        echo "<div class='admin-foto-karta'>";
        echo "<img src='$img' alt=''>";
        echo "<a class='zmaz-btn' 
                 href='?zmaz=$folder/$nazovSuboru'
                 onclick=\"return confirm('Naozaj zmazať túto fotku?')\">
                 Zmazať
              </a>";
        echo "</div>";
    }

    echo "</div>";
}
?>

</body>
</html>
