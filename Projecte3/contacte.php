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
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Formulari de consultes</h3>
                        </div>

                        <div class="card-body">

                            <?php
                                if (isset($_POST["enviar_consulta"])) {
                                    $consulta = $_POST["consulta"];
                                    $mobil = $_POST["mobil"];
                                    $id_usuari = $_SESSION['id_usuari_sessio'];
                                    $dia_hora = date("Y-m-d H:i:s");
                                    $consulta = "INSERT INTO formulari_consultes (id_usuari, pregunta, mobil, dia_hora) VALUES ('$id_usuari', '$consulta', '$mobil', '$dia_hora')";

                                    if ($connexio->query($consulta) === TRUE) {
                                        echo "<div class='alert alert-success' role='alert'>Registre de la consulta feta correctament. Ens posarem en contacte.</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'  role='alert'>Error al fer el registre de la consulta.</div>";

                                    }
                                }
                            ?>

                            <form method="POST" action="contacte.php">
                                <p class='text-muted text-center'>Ens posarem en contacte a través del telèfon mòbil o correu electrònic de l'usuari.</p> <br>
                                <div class="form-group row p-2">
                                    <label for="consulta" class="col-md-4 col-form-label text-md-right">Consulta:</label>

                                    <div class="col-md-6">
                                        <textarea name="consulta" id="consulta" class="form-control" rows="5" autofocus required></textarea>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="mobil" class="col-md-4 col-form-label text-md-right">Telèfon mòbil:</label>

                                    <div class="col-md-6">
                                        <input id="mobil" type="number" class="form-control" name="mobil" required min="1">
                                    </div>
                                </div>

                                <div class="form-group row mb-0 p-2">
                                    <div class="col-md-8 offset-md-4">
                                        <?php
                                            if(isset($_SESSION['id_usuari_sessio'])) {
                                                ?>
                                                    <button type="submit" name="enviar_consulta" class="btn btn-success">Enviar</button>
                                                <?php
                                            } else {
                                                echo "<p class='text-muted'>Inicia sessió per registrar consultes.</p>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
