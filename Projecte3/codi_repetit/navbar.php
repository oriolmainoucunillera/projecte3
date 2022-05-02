<!-- MENÚ DE NAVEGACIÓ DE L'APLICACIÓ -->

<?php
    function navbar() {
        ?>
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span id="ailled">Ailled</span> <!-- nom aplicació -->
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="activitats.php">Activitats</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="preguntes_faqs.php">Preguntes freqüents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="contacte.php">Contacte</a>
                        </li>
                    </ul>

                    <div class="d-flex">
                        <?php
                            if (isset($_SESSION['id_usuari_sessio'])) {
                                // Si existeix sessió fa aquesta part de la condició
                                ?>
                                    <a href="meu_perfil.php" class="btn btn-success">Perfil</a>

                                    <form action="" method="post">
                                        <button type="submit" name="sortir" class="ms-1 btn btn-danger">Sortir</button>
                                    </form>
                                <?php

                                if (isset($_POST['sortir'])) {
                                    session_destroy(); // tanquem la sessió
                                    header("LOCATION: index.php"); // redirigir l'usuari a index.php
                                }

                            } else {
                                // Si no hi ha sessió fa aquesta altre part de la condició
                                echo "<a class='btn btn-outline-success' id='registrar' href='registrar.php'>Registrar-me</a>";
                                echo "<a class='btn' href='iniciar_sessio.php' id='iniciarsessio'>Iniciar sessió</a>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        <?php
    }
?>