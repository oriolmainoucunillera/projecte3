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
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h3>Crear activitat</h3>
                                    </div>

                                    <div class="card-body">

                                        <?php
                                        if (isset($_POST['crear_activitats'])) {
                                            $nom = $_POST['nom_activitat'];
                                            $ubicacio = $_POST['ubicacio_activitat'];
                                            $descripcio = $_POST['descripcio_activitat'];
                                            $duracio = $_POST['duracio_activitat'];
                                            $participants = $_POST['participants_activitat'];
                                            $discapacitat = $_POST['discapacitat_activitat'];
                                            $dia_hora = $_POST['dia_hora_activitat'];
                                            $preu = $_POST['preu_activitat'];
                                            $arxiu = $_FILES['foto_activitat']['name'];

                                            if ($_FILES['foto_activitat']["error"] > 0) {
                                                ?>
                                                <div class="alert alert-danger" role="alert">
                                                    Error a l'omplir el formulari. Prova-ho de nou.
                                                </div>
                                                <?php
                                            } else {
                                                $img_nova = rand(1,1000) . "_" . $arxiu;
                                                move_uploaded_file($_FILES['foto_activitat']['tmp_name'], "imatges/activitats/" . $img_nova);

                                                $insertar_activitat = "INSERT INTO activitat (id_usuari,nom,ubicacio,descripcio,duracio,numero_participants,participants_disponibles,discapacitat_dirigida,dia_hora,preu,imatge,esta_acceptada) VALUES ('".$_SESSION['id_usuari_sessio']."','$nom','$ubicacio','$descripcio','$duracio','$participants','$participants','$discapacitat','$dia_hora','$preu','$img_nova',0)";

                                                if ($connexio->query($insertar_activitat) === TRUE) {
                                                    ?>
                                                    <div class="alert alert-success" role="alert">
                                                        Activitat afegida correctament, ara els administradors l'hauran d'acceptar.
                                                    </div>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        Error a l'omplir el formulari. Prova-ho de nou.
                                                    </div>
                                                    <?php
                                                            echo $connexio->error;
                                                }
                                            }
                                        }
                                        ?>

                                        <form method="POST" action="crear_activitat.php" enctype="multipart/form-data">
                                            <div class="row p-2">
                                                <p id="vermell">* Camps obligatoris.</p>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="nom" class="col-md-4 col-form-label text-md-right">
                                                    Nom de l'activitat: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="nom" type="text" class="form-control" name="nom_activitat" required autofocus>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="ubicacio" class="col-md-4 col-form-label text-md-right">
                                                    Ubicació: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="ubicacio" type="text" class="form-control" name="ubicacio_activitat" required>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="descripcio" class="col-md-4 col-form-label text-md-right">
                                                    Descripció: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <textarea name="descripcio_activitat" id="descripcio" rows="6" class="form-control" required></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="duracio" class="col-md-4 col-form-label text-md-right">
                                                    Duració: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="duracio" type="number" class="form-control" name="duracio_activitat" min="1" required>
                                                    <p class="form-text text-muted">Duració en hores aproximada.</p>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="participants" class="col-md-4 col-form-label text-md-right">
                                                    Participants disponibles: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="participants" type="number" class="form-control" name="participants_activitat" min="1" required>
                                                    <p class="form-text text-muted">Nombre de participants de l'activitat.</p>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="discapacitat" class="col-md-4 col-form-label text-md-right">
                                                    Discapacitat dirigida: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <select class="form-select" required name="discapacitat_activitat">
                                                        <option value="tothom">Activitat per a tothom</option>
                                                        <option value="cadira de rodes">Cadira de rodes</option>
                                                        <option value="sindrome de down">Sindrome de down</option>
                                                        <option value="altres">Altres</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="dia_hora" class="col-md-4 col-form-label text-md-right">
                                                    Dia i hora: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="dia_hora" type="datetime-local" class="form-control" name="dia_hora_activitat" required>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="preu" class="col-md-4 col-form-label text-md-right">
                                                    Preu: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="preu" type="number" class="form-control" name="preu_activitat" min="0" value="0" required>
                                                    <p class="form-text text-muted">Si l'activitat està subvencionada introdueix: 0.</p>
                                                </div>
                                            </div>

                                            <div class="form-group row p-2">
                                                <label for="imatges" class="col-md-4 col-form-label text-md-right">
                                                    Imatge: <span>*</span>
                                                </label>

                                                <div class="col-md-6">
                                                    <input id="imatges" type="file" class="form-control" name="foto_activitat" required>
                                                    <p class="form-text text-muted">Introdueix una imatge de portada.</p>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0 p-2">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" name="crear_activitats" class="btn btn-success">Crear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
