<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// ----------------------
// MAZANIE FOTIEK
// ----------------------
if (isset($_GET['zmaz'])) {
    $cesta = "../../obrazky/" . $_GET['zmaz'];
    if (file_exists($cesta)) {
        unlink($cesta);
        header("Location: nasa-praca.php");
        exit();
    }
}

// ----------------------
// UPLOAD FOTIEK
// ----------------------
if (isset($_POST['upload'])) {
    $kategoria = $_POST['kategoria'];
    $ciel = "../../obrazky/$kategoria/";

    // pre každú vybranú fotku
    foreach ($_FILES['foto']['tmp_name'] as $key => $tmp_name) {

        $nazov = basename($_FILES['foto']['name'][$key]);
        $typ = strtolower(pathinfo($nazov, PATHINFO_EXTENSION));

        if (in_array($typ, ["jpg","jpeg","png"])) {
            move_uploaded_file($tmp_name, $ciel . $nazov);
            echo "<p style='color:green'>Fotka $nazov pridaná do kategórie $kategoria</p>";
        } else {
            echo "<p style='color:red'>Neplatný formát: $nazov</p>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Admin – Naša práca</title>
</head>
<body>

<h1>Admin – Naša práca</h1>
<a href="dashboard.php">Späť na dashboard</a> | <a href="logout.php">Odhlásiť</a>

<h2>Pridať fotografiu</h2>
<form method="post" enctype="multipart/form-data">
    <input type="file" name="foto[]" multiple required>
    <select name="kategoria" required>
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

<hr>

<h2>Galéria (admin)</h2>

<?php
$kategorie = ["Kuchyne","Police","Skrine","Stoly","Postele","Predsien","Lekarne"];

foreach ($kategorie as $kat) {
    echo "<h3>$kat</h3>";
    $imgs = glob("../../obrazky/$kat/*.{jpg,jpeg,png}", GLOB_BRACE);

    if (empty($imgs)) {
        echo "<p>Žiadne fotografie.</p>";
        continue;
    }

    foreach ($imgs as $img) {
        $nazov = basename($img);
        echo "<div style='display:inline-block;margin:10px;text-align:center'>";
        echo "<img src='$img' width='150'><br>";
        echo "<a href='?zmaz=$kat/$nazov' onclick=\"return confirm('Naozaj zmazať túto fotku?')\">🗑️ Zmazať</a>";
        echo "</div>";
    }
}
?>
</body>
</html>
