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
                <h2>Qui som?</h2>

                <p>
                    <?php
                        $descripcio = "SELECT id, text FROM qui_som";
                        $resultat_descripcio = $connexio->query($descripcio);

                        while($row = $resultat_descripcio->fetch_assoc()) {
                            echo $row["text"];
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
