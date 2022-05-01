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
            <section id="buscar_activitats">
                <?php
                    if (isset($_SESSION["id_usuari_sessio"])) {
                        ?>
                            <a href="crear_activitat.php" class="btn btn-info">Crear activitat</a>
                        <?php
                    }
                ?>

                <h2>Buscar activitats</h2>

                <form action="activitats.php" method="post">
                    <div class="form-group row">
                        <label for="dates" class="col-sm-2 col-form-label">Introdueix una data:</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="dates" name="dates_buscar" required>
                        </div>
                    </div>
                    <div class="form-group py-3">
                        <input type="submit" value="Buscar" name="submit_dates_buscar" class="btn btn-primary">
                    </div>
                </form>

                <?php
                    if (isset($_POST["submit_dates_buscar"])) {
                        $dates = $_POST["dates_buscar"];

                        $sql_dates_buscar = "SELECT * FROM activitat WHERE dia_hora BETWEEN '$dates 00:00:00' AND '$dates 23:59:59' AND esta_acceptada = 1 AND participants_disponibles > 0 ORDER BY dia_hora ASC";
                        $result_dates_buscar = $connexio->query($sql_dates_buscar);

                        if ($result_dates_buscar->num_rows > 0) {
                            while($row_dates_buscar = $result_dates_buscar->fetch_assoc()) {
                                ?>
                                <div class="col-lg-4 mb-4">
                                    <div class="card">
                                        <?php
                                            echo "<img src='imatges/activitats/". $row_dates_buscar["imatge"] ."' alt='". $row_dates_buscar["id"] ."' class='card-img-top' height='250'>";
                                        ?>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php
                                                    echo $row_dates_buscar["nom"];
                                                ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php
                                                    echo $row_dates_buscar["descripcio"];
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Creada per:
                                                <?php
                                                    $sql_usuari = "SELECT nom FROM usuari WHERE id=" . $row_dates_buscar["id_usuari"];
                                                    $resultat_usuari = $connexio->query($sql_usuari);

                                                    if ($resultat_usuari->num_rows > 0) {
                                                        while($row_usuari = $resultat_usuari->fetch_assoc()) {
                                                            echo $row_usuari["nom"] . ".";
                                                        }
                                                    } else {
                                                        echo "Usuari desconegut.";
                                                    }
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Ubicació:
                                                <?php
                                                echo $row_dates_buscar["ubicacio"] . ".";
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Participants en total:
                                                <?php
                                                    echo $row_dates_buscar["numero_participants"] . ".";
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Places disponibles:
                                                <?php
                                                    echo $row_dates_buscar["participants_disponibles"] . ".";
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Activitat dirigida:
                                                <?php
                                                    echo $row_dates_buscar["discapacitat_dirigida"] . ".";
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Dia i hora:
                                                <?php
                                                    echo $row_dates_buscar["dia_hora"] . ".";
                                                ?>
                                            </p>
                                            <p class="card-text">
                                                Preu:
                                                <?php
                                                    if($row_dates_buscar["preu"] == 0) {
                                                        echo "Activitat gratuïta o subvencionada.";
                                                    } else {
                                                        echo $row_dates_buscar["preu"] . "€.";
                                                    }
                                                ?>
                                            </p>
                                            <div class="progress">
                                                <?php
                                                    $barra_progres = ($row_dates_buscar["participants_disponibles"] / $row_dates_buscar["numero_participants"]) * 100;
                                                    echo "<div class='progress-bar bg-success' role='progressbar' style='width: $barra_progres%' aria-valuenow='$barra_progres' aria-valuemin='0' aria-valuemax='100'></div>";
                                                ?>
                                            </div>
                                            <?php
                                                echo "<p class='text-center text-muted'>" . round($barra_progres) . "% disponible.";
                                            ?>
                                            <div class="veuremes">
                                                <a href="detalls_activitat.php?id=<?php echo $row_dates_buscar["id"]?>" class="btn btn-success">Veure més</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Cap activitat trobada amb aquesta data.</h4>
                                </div>
                            <?php
                        }
                    }
                ?>
            </section>

            <hr>

            <section id="activitats">
                <h2>Totes les activitats</h2>

                <div class="row">

                    <?php
                        $data_ara = date("Y-m-d H:i:s");
                        $sql = "SELECT * FROM activitat WHERE dia_hora >= '$data_ara' AND esta_acceptada = 1 AND participants_disponibles > 0 ORDER BY dia_hora ASC";
                        $result = $connexio->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                    <div class="col-lg-4 mb-4">
                                        <div class="card">
                                            <?php
                                                echo "<img src='imatges/activitats/". $row["imatge"] ."' alt='". $row["id"] ."' class='card-img-top' height='250'>";
                                            ?>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php
                                                        echo $row["nom"];
                                                    ?>
                                                </h5>
                                                <p class="card-text">
                                                    <?php
                                                        echo $row["descripcio"];
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Creada per:
                                                    <?php
                                                        $sql_usuari = "SELECT nom FROM usuari WHERE id=" . $row["id_usuari"];
                                                        $resultat_usuari = $connexio->query($sql_usuari);

                                                        if ($resultat_usuari->num_rows > 0) {
                                                            while($row_usuari = $resultat_usuari->fetch_assoc()) {
                                                                echo $row_usuari["nom"] . ".";
                                                            }
                                                        } else {
                                                            echo "Usuari desconegut.";
                                                        }
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Ubicació:
                                                    <?php
                                                        echo $row["ubicacio"] . ".";
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Participants en total:
                                                    <?php
                                                        echo $row["numero_participants"] . ".";
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Places disponibles:
                                                    <?php
                                                        echo $row["participants_disponibles"] . ".";
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Activitat dirigida:
                                                    <?php
                                                        echo $row["discapacitat_dirigida"] . ".";
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Dia i hora:
                                                    <?php
                                                        echo $row["dia_hora"] . ".";
                                                    ?>
                                                </p>
                                                <p class="card-text">
                                                    Preu:
                                                    <?php
                                                        if($row["preu"] == 0) {
                                                            echo "Activitat gratuïta o subvencionada.";
                                                        } else {
                                                            echo $row["preu"] . "€.";
                                                        }
                                                    ?>
                                                </p>
                                                <div class="progress">
                                                    <?php
                                                        $barra_progres = ($row["participants_disponibles"] / $row["numero_participants"]) * 100;
                                                        echo "<div class='progress-bar bg-success' role='progressbar' style='width: $barra_progres%' aria-valuenow='$barra_progres' aria-valuemin='0' aria-valuemax='100'></div>";
                                                    ?>
                                                </div>
                                                <?php
                                                    echo "<p class='text-center text-muted'>" . round($barra_progres) . "% disponible.";
                                                ?>
                                                <div class="veuremes">
                                                    <a href="detalls_activitat.php?id=<?php echo $row["id"]?>" class="btn btn-success">Veure més</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        } else {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Cap activitat disponible!</h4>
                                    <hr>
                                    <p class="mb-0">Crea una activitat i poder coneixer gent.</p> <br>
                                    <a href="crear_activitat.php" class="btn btn-outline-danger">Crear activitat</a>
                                </div>
                            <?php
                        }
                    ?>
                </div>
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
