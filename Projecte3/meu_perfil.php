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
                        <?php
                            if ($_SESSION['es_admin_usuari_sessio'] == 1) { // si l'usuari és admin es mostra aquests enllaços
                                ?>
                                    <a href="admin_tots_usuaris_registrats.php" class="btn btn-outline-primary">Usuaris registrats</a>
                                    <a href="admin_veure_consultes_usuaris.php" class="btn btn-outline-primary">Consultes usuaris</a>
                                    <a href="admin_acceptar_activitats.php" class="btn btn-outline-success">Acceptar activitats</a>
                                    <a href="admin_preguntes_frequents.php" class="btn btn-outline-success">Preguntes freqüents</a>
                                <?php
                            }
                        ?>

                        <div class="row justify-content-center pt-4">
                            <div class="col-md-8" id="info_perfil">
                                <div class="card w-80">
                                    <div class="card-body">
                                        <h2 class="card-title text-center">El meu perfil</h2>
                                        <hr>
                                        <?php
                                            if($_SESSION['es_admin_usuari_sessio'] == 1) { // si l'usuari és administrador es mostra aquest missatge
                                                echo "<p class='text-muted'>(*) Ets admin de la pàgina.</p>";
                                            }
                                            echo "<h4 class='card-text'>" . $_SESSION['nom_usuari_sessio'] . "</h4> <br>";
                                            echo "<p class='card-text'>Nom d'usuari: " . $_SESSION['username_usuari_sessio'] . "</p>";
                                            echo "<p class='card-text'>Correu electrònic: " . $_SESSION['correu_usuari_sessio'] . "</p>";
                                            echo "<p class='card-text'>Localitat: " . $_SESSION['localitat_usuari_sessio'] . "</p>";
                                        ?>
                                        <hr>
                                        <a href="crear_activitat.php" class="btn btn-success">Crear activitat</a>
                                        <a href="registrat_activitats.php" class="btn btn-primary">Activitats apuntades</a>
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
