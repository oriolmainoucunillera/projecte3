<?php
    include "servidor/connexio_PDO.php";
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
                            <h3>Registre</h3>
                        </div>

                        <div class="card-body">
                            <?php
                                if (isset($_POST['registrar'])) {
                                    $nom = $_POST['nom'];
                                    $email = $_POST['email'];
                                    $username = $_POST['username'];
                                    $localitat = $_POST['localitat'];
                                    $password = $_POST['password'];
                                    $password2 = $_POST['password2'];
                                    $imatge_perfil = "sensefoto.jpg";

                                    $contrasenya_xifrada = password_hash($password, PASSWORD_DEFAULT, array("cost"=>12));

                                    $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $connexio_PDO->exec("SET CHARACTER SET utf8");

                                    if ($password == $password2) {
                                        $sql_afegir_usuari = "INSERT INTO usuari (nom,username,correu,contrasenya,localitat,foto_perfil,es_admin) VALUES (:nom,:username,:email,:contrasenya,:localitat,:foto_perfil,0)";
                                        $resultat = $connexio_PDO->prepare($sql_afegir_usuari);
                                        $resultat->execute(array(
                                            ":nom" => $nom,
                                            ":username" => $username,
                                            ":email" => $email,
                                            ":contrasenya" => $contrasenya_xifrada,
                                            ":localitat" => $localitat,
                                            ":foto_perfil" => $imatge_perfil
                                            )
                                        );

                                        echo "<div class='alert alert-success' role='alert'>Registre fet correctament. Inicia sessió.</div>";
                                    } else {
                                        echo "<div class='alert alert-danger'  role='alert'>Error al fer el registre. Comprova les teves dades.</div>";
                                    }
                                }
                            ?>

                            <form method="POST" action="registrar.php">
                                <div class="row p-2">
                                    <p id="vermell">* Camps obligatoris.</p>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="nom" class="col-md-4 col-form-label text-md-right">
                                        Nom i cognoms: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control" name="nom" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        Correu electronic: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="username" class="col-md-4 col-form-label text-md-right">
                                        Nom d'usuari: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="username" type="text" class="form-control" name="username" required>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="localitat" class="col-md-4 col-form-label text-md-right">
                                        Localitat: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="localitat" type="text" class="form-control" name="localitat" required>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">
                                        Contrasenya: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="password" minlength="8" type="password" class="form-control" name="password" required>
                                        <small id="passwords" class="form-text text-muted">
                                            La contrasenya ha de tenir minim 8 caracters.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="npassword" class="col-md-4 col-form-label text-md-right">
                                        Repeteix la contrasenya: <span>*</span>
                                    </label>

                                    <div class="col-md-6">
                                        <input id="npassword" type="password" class="form-control" name="password2" required>
                                        <small id="pwd" class="form-text text-muted">
                                            Comprova que has escrit la mateixa contrasenya.
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 p-2">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" name="registrar" class="btn btn-success">Registrar</button>
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
