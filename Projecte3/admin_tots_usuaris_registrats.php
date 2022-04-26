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
                            <h2>Usuaris registrats a la pàgina</h2>

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Nom usuari</th>
                                        <th scope="col">Correu electrònic</th>
                                        <th scope="col">Localitat</th>
                                        <th scope="col">Activitats pendents</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql_consultes = "SELECT * FROM usuari";
                                        $resultat_consultes = $connexio->query($sql_consultes);

                                        if ($resultat_consultes->num_rows > 0) {
                                            while($row = $resultat_consultes->fetch_assoc()) {
                                                echo "<tr>";
                                                    echo "<td>" . $row['id'] . "</td>";
                                                    echo "<td>" . $row['nom'] . "</td>";
                                                    echo "<td>" . $row['username'] . "</td>";
                                                    echo "<td>" . $row['correu'] . "</td>";
                                                    echo "<td>" . $row['localitat'] . "</td>";
                                                    echo "<td>";
                                                        $data_ara = date("Y-m-d H:i:s");
                                                        $select_act = "SELECT * FROM activitat WHERE dia_hora >= '$data_ara' AND esta_acceptada = 1 AND id_usuari=" . $row['id'] . " ORDER BY dia_hora ASC";
                                                        $resultatss = $connexio->query($select_act);
                                                        if ($resultatss->num_rows > 0) {
                                                            while($row_act = $resultatss->fetch_assoc()) {
                                                                echo "- " . $row_act["nom"] . "<br>";
                                                            }
                                                        } else {
                                                            echo "------";
                                                        }
                                                    echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr>";
                                                echo "<td colspan='6'>No hi ha cap consulta / pregunta.</td>";
                                            echo "</tr>";
                                        }
                                    ?>

                                </tbody>
                            </table>
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
