<?php
    include "servidor/connexio.php";
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
                            <h3>Iniciar sessió</h3>
                        </div>

                        <div class="card-body">
                            <?php
                                // Inicio sessió per PDO
                                if (isset($_POST['iniciar_sessio'])) {
                                    $email = htmlentities(addslashes($_POST['email'])); // email posat al form
                                    $password = htmlentities(addslashes($_POST['password'])); // contrasenya posada al form
                                    $contador = 0;

                                    $connexio_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $sql = "SELECT * FROM usuari WHERE correu=:email"; // si existeix aquest mail a la BBDD
                                    $resultat_inici_sessio = $connexio_PDO->prepare($sql);
                                    $resultat_inici_sessio->execute(array(":email" => $email));

                                    while ($registre = $resultat_inici_sessio->fetch(PDO::FETCH_ASSOC)) {
                                        if (password_verify($password, $registre['contrasenya'])) { // verifiquem la contrsenya si és correcte
                                            $contador++;

                                            // Obrim la sessió i els hi dono dades
                                            $_SESSION['id_usuari_sessio'] = $registre['id'];
                                            $_SESSION['nom_usuari_sessio'] = $registre['nom'];
                                            $_SESSION['username_usuari_sessio'] = $registre['username'];
                                            $_SESSION['correu_usuari_sessio'] = $registre['correu'];
                                            $_SESSION['localitat_usuari_sessio'] = $registre['localitat'];
                                            $_SESSION['es_admin_usuari_sessio'] = $registre['es_admin'];
                                            $_SESSION['img_perfil_usuari_sessio'] = $registre['foto_perfil'];
                                        }
                                    }

                                    if ($contador > 0) { // si contador és 0 envio a l'usuari a index.php
                                        header ("Location: index.php");
                                    } else { // si hi ha un error li mostro el missatge següent
                                        echo "<div class='alert alert-danger' role='alert'>Error. Comprova que has escrit bé el correu i la contrasenya.</div>";

                                    }
                                }
                            ?>

                            <form method="POST" action="iniciar_sessio.php">
                                <div class="form-group row p-2">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Correu electronic:</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row p-2">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Contrasenya:</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 p-2">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" name="iniciar_sessio" class="btn btn-success">Entrar</button>
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
