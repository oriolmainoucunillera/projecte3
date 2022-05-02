<?php
    include "servidor/connexio.php";
?>

<!doctype html>
<html lang="es">
<head>
    <?php
        include "codi_repetit/head.php";
        head();
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <?php
            include "codi_repetit/navbar.php";
            navbar();
        ?>
    </nav>

    <main>
        <div class="container">
            <section id="que_realitzem">
                <h2>Preguntes freqüents (FAQS)</h2>
                <p>
                    <?php
                        $descripcio = "SELECT * FROM faqs"; // seleccionem tota la taula de faqs
                        $resultat_descripcio = $connexio->query($descripcio);

                        while($row = $resultat_descripcio->fetch_assoc()) {
                            ?>
                                <div class="card bg-light mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">- <?php echo $row["titol"]; ?></h5>
                                        <p class="card-text"><?php echo $row["text"]; ?></p>
                                    </div>
                                </div>
                            <?php
                        }
                    ?>
                </p>
            </section>
        </div>
    </main>

    <footer>
        <?php
            include "codi_repetit/footer.php";
            footer();
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
