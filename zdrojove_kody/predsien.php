<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

    <title>PEKRA s.r.o.</title>
</head>
<body>
    <div class="top-bar">
        <span><i class="fa-solid fa-phone"></i> +421 905 631 839</span>
        <span><i class="fa fa-envelope"></i> info@pekra.sk</span>
    </div>
    <section class="uvod1">
        <header class="header">
            <a href="index.html">
                <img src="../obrazky/logo.jpg" alt="logo" class="logo">
            </a>

            <!-- checkbox -->
            <input type="checkbox" id="menu-toggle">

            <!-- hamburger -->
            <label for="menu-toggle" class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </label>

            <nav class="nav-bar">
                <a class="uvod-menu" href="index.html">Úvod</a>
                <a href="sluzby.html">Služby</a>
                <a href="nasa-praca.php">Naša práca</a>
                <a href="o-nas.html">O nás</a>
                <a href="kontakt.html">Kontakt</a>
            </nav>
        </header>
        <section class="nazov-podstranky">
            <h1>PREDSIEŇOVÝ NÁBYTOK</h1>
        </section>
    </section>

    <section class="galeria">
        <?php
        $kat = "predsien"; // názov kategórie
        $obrazky = glob("../obrazky/$kat/*.{jpg,jpeg,png}", GLOB_BRACE);

        if (empty($obrazky)) {
            echo "<p>Zatiaľ žiadne realizácie ".strtoupper($kat).".</p>";
        } else {
            foreach ($obrazky as $img) {
                echo "<a href='$img' data-lightbox='galeria-$kat'>";
                echo "<img src='$img' class='galeria-img'>";
                echo "</a>";
            }
        }
        ?>
</section>
    <footer class="footer">
        <p>&#169; 2025 Pekra. Všetky práva vyhradené.</p>
        <p>Vytvorili Nikola Petrašková a Sofia Borbuliaková</p>
    </footer>
</body>
</html>