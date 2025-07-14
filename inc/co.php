<?php
ini_set('display_errors', '1');
function dbconnect()
{
    static $connect = null;

    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'ETU004147', 'YfNgrYcc', 'db_s2_ETU004147');

        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }
    }

    return $connect;
}
