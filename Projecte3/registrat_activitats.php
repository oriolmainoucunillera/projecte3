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
    <?php
        if(isset($_SESSION["id_usuari_sessio"])) {
            ?>
                <main>
                    <div class="container p-5">
                        <h3>Activitats on estic apuntat</h3>
                        <p>Aquí es mostren totes les activitats on t'has registrat i han estat acceptades.</p> <br>
                        <div class="row">
                            <?php
                                $sql_participants_apuntats = "SELECT * FROM participants_apuntats WHERE id_usuari = " . $_SESSION['id_usuari_sessio'];
                                $result_participants_apuntats = $connexio->query($sql_participants_apuntats);

                                if ($result_participants_apuntats->num_rows > 0) {
                                    while ($row_participants_apuntats = $result_participants_apuntats->fetch_assoc()) {
                                        $id_activitats = $row_participants_apuntats["id_activitat"];

                                        $sql = "SELECT * FROM activitat WHERE id = '$id_activitats' AND esta_acceptada = 1 ORDER BY dia_hora ASC";
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
                                                                Persones que has apuntat:
                                                                <?php
                                                                    echo $row_participants_apuntats["numero_participants"] . ".";
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
                                                            <?php
                                                                $data_ara = date("Y-m-d H:i:s");

                                                                if ($row["dia_hora"] >= $data_ara) {
                                                                    ?>
                                                                        <div class="veuremes">
                                                                            <a href="detalls_activitat.php?id=<?php echo $row["id"]?>" class="btn btn-success">Veure més</a>
                                                                        </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                        <h3 class="card-text text-muted text-center">
                                                                            Activitat ja vençuda.
                                                                        </h3>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                } else {
                                    ?>
                                        <div class="alert alert-danger" role="alert">
                                            No t'has registrat a cap activitat.
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </main>
            <?php
        } else {
            header("LOCATION: index.php");
        }
    ?>

    <footer>
        <?php
            include "codi_repetit/footer.php";
            footer();
        ?>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
