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
        if ($_SESSION['es_admin_usuari_sessio'] == 1) {
            // Si l'usuari és administrador fa aquesta condició
            ?>
                <main>
                    <div class="container">
                        <section id="activitats">
                            <h2>Acceptar activitats dels usuaris</h2>

                            <?php
                                if (isset($_POST["acceptada"])) {
                                    $identificador = $_POST["num_id"];

                                    $update = "UPDATE activitat SET esta_acceptada=1 WHERE id=" . $identificador; // sentencia per actualitzar

                                    if ($connexio->query($update) === TRUE) {
                                        // Missatge conforma s'ha acceptat l'activitat
                                        ?>
                                            <div class="alert alert-success" role="alert">
                                                Activitat acceptada.
                                            </div>
                                        <?php
                                    }
                                }

                                if (isset($_POST["esborrar"])) {
                                    $identificador = $_POST["num_id"];

                                    $delete = "DELETE FROM activitat WHERE id=" . $identificador; // sentencia per eliminar

                                    if ($connexio->query($delete) === TRUE) {
                                        // Missatge conforma s'ha eliminat l'activitat (no és acceptada)
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                Activitat eliminada. Ja no podrà ser acceptada.
                                            </div>
                                        <?php
                                    }
                                }
                            ?>

                            <div class="row">
                                <?php
                                    $sql = "SELECT * FROM activitat WHERE esta_acceptada = 0 ORDER BY id DESC"; // posem ordre DESC segons la ID
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
                                                                // Busquem el nom de l'usuari que ha creat l'activitat
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
                                                            Discapacitat dirigida:
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
                                                                if($row["preu"] == 0) { // si el preu és 0 fa aquesta condició
                                                                    echo "Activitat gratuïta o subvencionada.";
                                                                } else { // si el preu no és 0 fa aquesta condició
                                                                    echo $row["preu"] . "€.";
                                                                }
                                                            ?>
                                                        </p>

                                                        <form action="admin_acceptar_activitats.php" method="post">
                                                            <input type="hidden" name="num_id" value="<?php echo $row["id"]; ?>"> <!-- aquest input no es mostra per pantalla -->
                                                            <input type="submit" value="Acceptar" name="acceptada" class="btn btn-success">
                                                        </form>
                                                        <br>

                                                        <form action="admin_acceptar_activitats.php" method="post">
                                                            <input type="hidden" name="num_id" value="<?php echo $row["id"]; ?>"> <!-- aquest input no es mostra per pantalla -->
                                                            <input type="submit" value="Esborrar" name="esborrar" class="btn btn-danger">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        // Si no hi ha cap activitat per acceptar es mostrarà aquest apartat:
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                <h4 class="alert-heading">Cap activitat per acceptar</h4>
                                                <hr>
                                                <p class="mb-0">No hi ha cap activitat per acceptar/rebutjar.</p> <br>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>

                        </section>
                    </div>
                </main>
            <?php
        } else { // si no és administrador fa aquesta condició
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
