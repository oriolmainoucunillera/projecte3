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
            ?>
                <main>
                    <div class="container">
                        <section>
                            <h2>Administrar preguntes freqüents (FAQS)</h2>

                            <h4>Crear preguntes freqüents</h4>

                            <?php
                                if (isset($_POST["enviar_faqs"])) {
                                    $id_usuari = $_SESSION['id_usuari_sessio'];
                                    $titol = $_POST['titol'];
                                    $text = $_POST['resposta'];
                                    $afegir = "INSERT INTO faqs (id_usuari, titol, text) VALUES ('$id_usuari', '$titol', '$text')"; // sentencia per afegir a la BBDD

                                    if ($connexio->query($afegir) === TRUE) { // si insert ha funcionat fa aquesta condició
                                        ?>
                                            <div class="alert alert-success" role="alert">
                                                Pregunta freqüent creada.
                                            </div>
                                        <?php
                                    }
                                }
                            ?>

                            <div style="padding: 10px 0">
                                <form action="admin_preguntes_frequents.php" method="post">
                                    <div class="form-group">
                                        <label for="titol">Titol FAQS</label>
                                        <input type="text" class="form-control" name="titol" id="titol" required maxlength="35">
                                    </div>
                                    <div class="form-group pt-1">
                                        <label for="text">Resposta FAQS</label>
                                        <textarea name="resposta" id="text" rows="3" class="form-control" required></textarea>
                                    </div>
                                    <div class="pt-2">
                                        <input type="submit" class="btn btn-success" name="enviar_faqs" value="Crear">
                                    </div>
                                </form>
                            </div>

                            <hr>

                            <h4>Preguntes freqüents ja creades</h4>

                            <?php
                                if (isset($_POST["eliminar_faqs"])) {
                                    $identificador = $_POST["num_id"];

                                    $update = "DELETE FROM faqs WHERE id=" . $identificador; // sentencia per eliminar

                                    if ($connexio->query($update) === TRUE) { // si s'ha eliminat correctament fa aquesta condició
                                        ?>
                                            <div class="alert alert-danger" role="alert">
                                                Consulta eliminada.
                                            </div>
                                        <?php
                                    }
                                }
                            ?>

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Usuari pregunta</th>
                                            <th scope="col">Titol</th>
                                            <th scope="col">Text</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM faqs"; // seleccionem tota la taula "faqs"
                                            $result = $connexio->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Si la consulta conté dades fa aquesta condició
                                                while($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                        echo "<td>" . $row["id"] . "</td>";
                                                        echo "<td>";
                                                            $sql_usuari = "SELECT nom FROM usuari WHERE id=" . $row["id_usuari"];
                                                            $result_usuari = $connexio->query($sql_usuari);

                                                            if ($result_usuari->num_rows > 0) {
                                                                while($row_usuari = $result_usuari->fetch_assoc()) {
                                                                    echo $row_usuari["nom"];
                                                                }
                                                            }
                                                        echo "</td>";
                                                        echo "<td>" . $row["titol"] . "</td>";
                                                        echo "<td>" . $row["text"] . "</td>";
                                                        echo "<td>";
                                                            echo "<form action='admin_preguntes_frequents.php' method='post'>";
                                                                echo "<input type='hidden' name='num_id' value='" . $row["id"] . "'>";
                                                                echo "<input type='submit' name='eliminar_faqs' value='Eliminar' class='btn btn-danger'>";
                                                            echo "</form>";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                // Si la consulta no conté dades fa aquesta condició
                                                echo "<tr>";
                                                    echo "<td colspan='5'>Cap resultat</td>";
                                                echo "</tr>";
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </section>
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
