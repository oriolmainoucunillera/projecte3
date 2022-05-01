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
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Activitat 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Activitat 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Activitat 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Activitat 4"></button>
            </div>
            <div id="carruselImatges" class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imatges/portada/imatge1.jpg" class="d-block w-100" alt="Activitat 1">
                </div>
                <div class="carousel-item">
                    <img src="imatges/portada/imatge2.jpg" class="d-block w-100" alt="Activitat 2">
                </div>
                <div class="carousel-item">
                    <img src="imatges/portada/imatge3.jpg" class="d-block w-100" alt="Activitat 3">
                </div>
                <div class="carousel-item">
                    <img src="imatges/portada/imatge4.jpg" class="d-block w-100" alt="Activitat 4">
                </div>
            </div>
        </div>

        <div class="container">
            <section id="qui_som">
                <h2>Qui som i que realitzem?</h2>

                <p>
                    AILLED som una associació que organitza activitats culturals i esportives per a persones amb discapacitat per a que puguin dur a terme activitats grupals.
                    A més, cada usuari pot crear la seva pròpia activitat sent cada una d'elles validada pels administradors de la pàgina.
                    Es busca que aquestes activitats lúdiques siguin sempre gratuïtes (subvencionades per associacions/fundacions) o bé de preus molt reduïts pels seus beneficiaris.
                </p>

                <p>
                    Crea, apuntat i participa. T'esperem a AILLED!
                </p>
            </section>

            <hr>

            <section id="activitats">
                <h2>Últimes activitats creades</h2>

                <div class="row">
                    <?php
                        $data_ara = date("Y-m-d H:i:s");

                        $sql = "SELECT * FROM activitat WHERE dia_hora >= '$data_ara' AND esta_acceptada = 1 AND participants_disponibles > 0 ORDER BY dia_hora ASC LIMIT 6";
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
