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
        if ($_SESSION['es_admin_usuari_sessio'] == 1) { // si és administrador fa aquesta condició
            ?>
                <main>
                    <div class="container">
                        <section>
                            <h2>Consultes dels usuaris</h2>

                            <?php
                                if (isset($_POST["eliminar_consulta"])) {
                                    $identificador = $_POST["num_id"];

                                    $update = "DELETE FROM formulari_consultes WHERE id=" . $identificador; // eliminar consulta

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
                                            <th scope="col">Usuari</th>
                                            <th scope="col">Consulta/pregunta</th>
                                            <th scope="col">Telèfon mòbil</th>
                                            <th scope="col">Correu electronic</th>
                                            <th scope="col">Dia i hora</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql_consultes = "SELECT * FROM formulari_consultes"; // seleccionem tot de la taula "formulari_consultes"
                                            $resultat_consultes = $connexio->query($sql_consultes);

                                            if ($resultat_consultes->num_rows > 0) {
                                                while($row = $resultat_consultes->fetch_assoc()) {
                                                    echo "<tr>";
                                                        echo "<td>" . $row['id'] . "</td>";

                                                        $sql_consulta_usuari = "SELECT * FROM usuari WHERE id=" . $row['id_usuari'];
                                                        $resultat_consulta_usuari = $connexio->query($sql_consulta_usuari);
                                                        while($row2 = $resultat_consulta_usuari->fetch_assoc()) {
                                                            echo "<td>" . $row2['nom'] . "</td>"; // nom de l'usuari
                                                        }

                                                        echo "<td>" . $row['pregunta'] . "</td>";
                                                        echo "<td>" . $row['mobil'] . "</td>";

                                                        $sql_consulta_email = "SELECT * FROM usuari WHERE id=" . $row['id_usuari'];
                                                        $resultat_consulta_email = $connexio->query($sql_consulta_email);
                                                        while($row3 = $resultat_consulta_email->fetch_assoc()) {
                                                            echo "<td>" . $row3['correu'] . "</td>"; // mail de l'usuari
                                                        }

                                                        echo "<td>" . $row['dia_hora'] . "</td>";
                                                        echo "<td>";
                                                            // formulari per eliminar la consulta
                                                            echo "<form action='admin_veure_consultes_usuaris.php' method='post' name='eliminar_consulta'>";
                                                                echo "<input type='hidden' name='num_id' value='" . $row["id"] . "'>"; // no es mostra aquest input (està hidden)
                                                                echo "<input type='submit' name='eliminar_consulta' value='Eliminar' class='btn btn-danger'>";
                                                            echo "</form>";
                                                        echo "</td>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "<tr>";
                                                    // Si no hi ha cap consulta/pregunta fa aquesta condició
                                                    echo "<td colspan='6'>No hi ha cap consulta / pregunta.</td>";
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
