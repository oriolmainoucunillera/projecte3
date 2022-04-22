<?php
    session_start(); // obrim la sessió per a PDO

    // Connexió per a la PDO
    $connexio_PDO = new PDO('mysql:host=localhost;dbname=projectemedia','root','');

?>