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
            <section id="activitat">
                <?php
                    if (isset($_POST["registrar_activitat"])) {
                        $participants_act_registrat = $_POST["participants_act_registrat"];
                        $id_act_registrat = $_POST["id_act_registrat"];

                        $insertar_participants_apuntats  = "INSERT INTO participants_apuntats (id_activitat,id_usuari,numero_participants) VALUES ('$id_act_registrat', '" . $_SESSION['id_usuari_sessio'] . "', '$participants_act_registrat')";
                        $update_participants_disponibles = "UPDATE activitat SET participants_disponibles = participants_disponibles - " . $participants_act_registrat . " WHERE id=" . $id_act_registrat;

                        if ($connexio->query($insertar_participants_apuntats) === TRUE && $connexio->query($update_participants_disponibles) === TRUE) {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    T'has registrat a l'activitat correctament!
                                </div>
                            <?php
                        } else {
                            echo "Error: " . $sql . "<br>" . $connexio->error;
                        }
                    }
                ?>

                <!------------>

                <?php
                    $id_activitat_actual = $_GET['id'];

                    $sql = "SELECT * FROM activitat WHERE id=" . $id_activitat_actual;
                    $result = $connexio->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            ?>
                                <div class="card mb-3">
                                    <img class="card-img-top" src="imatges/activitats/<?php echo $row['imatge'] ?>" title="<?php echo $row['nom'] ?>" alt="<?php echo $row['nom'] ?>" height="400" >
                                    <div class="card-body">
                                        <h3 class="card-title"><?php echo $row['nom'] ?></h3>
                                        <p class="card-text">Ubicació de quedada: <?php echo $row['ubicacio'] ?></p>
                                        <p class="card-text">Descripció de l'activitat: <?php echo $row['descripcio'] ?></p>
                                        <p class="card-text">Duració: <?php echo $row['duracio'] ?> hores</p>
                                        <p class="card-text">Nombre de participants: <?php echo $row['numero_participants'] ?></p>
                                        <p class="card-text">Participants disponibles: <?php echo $row['participants_disponibles'] ?></p>
                                        <p class="card-text">Activitat dirigida a: <?php echo $row['discapacitat_dirigida'] ?></p>
                                        <p class="card-text">Dia i hora: <?php echo $row['dia_hora'] ?></p>
                                        <p class="card-text">Preu:
                                            <?php
                                                if ($row['preu'] == 0) {
                                                    echo "Activitat totalment gratuïta";
                                                } else {
                                                    echo $row['preu'] . "€";
                                                }
                                            ?>
                                        </p>
                                        <?php
                                            if (isset($_SESSION["id_usuari_sessio"])) {
                                                ?>
                                                    <form action="detalls_activitat.php?id=<?php echo $id_activitat_actual ?>" method="post" class="pt-3">
                                                        <input type="hidden" name="id_act_registrat" value="<?php echo $id_activitat_actual ?>">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="number" name="participants_act_registrat" class="form-control" placeholder="Num participants" min="1" max="<?php echo $row['participants_disponibles'] ?>" required>
                                                            </div>
                                                            <div class="col">
                                                                <input type="submit" value="Apuntar" class="btn btn-outline-primary" name="registrar_activitat">
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php
                                            } else {
                                                ?>
                                                    <h5 class="card-text text-muted text-center">
                                                        Si vol apuntar-se a l'activitat inicia sessió.
                                                    </h5>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php
                        }
                    } else {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <p>Cap activitat amb aquesta ID.</p>
                                <a href="index.php" class="btn btn-primary">Tornar a l'inici</a>
                            </div>
                        <?php
                    }
                ?>
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
