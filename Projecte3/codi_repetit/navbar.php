<?php
    function navbar() {
        ?>
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <span id="ailled">Ailled</span>
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
                            <a class="nav-link text-dark" href="que_realitzem.php">Que realitzem?</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="contacte.php">Contacte</a>
                        </li>
                    </ul>

                    <div class="d-flex">
                        <?php
                            if (isset($_SESSION['id_usuari_sessio'])) {
                                ?>
                                    <a href="meu_perfil.php" class="btn btn-success">Perfil</a>

                                    <form action="" method="post">
                                        <button type="submit" name="sortir" class="ms-1 btn btn-danger">Sortir</button>
                                    </form>
                                <?php

                                if (isset($_POST['sortir'])) {
                                    session_destroy();
                                    header("LOCATION: index.php");
                                }

                            } else {
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