<?php
    session_start(); // obrim la sessió

    // Fem la connexió
    $connexio = new mysqli("localhost", "root", "", "projectemedia");
    $connexio->set_charset("utf8");

    // Comprovar si funciona --> si no funciona es mostra un error a la web
    if ($connexio->connect_error) {
        die("ERROR: " . $connexio->connect_error);
    }

    $expireAfter = 15;

    if (isset($_SESSION['last_action'])) {
        $secondsInactive = time() - $_SESSION['last_action'];
        $expireAfterSeconds = $expireAfter * 60;

        if ($secondsInactive >= $expireAfterSeconds) {
            session_destroy();
        }
    }

    $_SESSION['last_action'] = time();
?>