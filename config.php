<?php
    // Set up connection to db
    $server = 'localhost'; // 127.0.0.1 is the same as localhost
    $server_prd = 'host-address'; // for hosting production

    $user = 'root';
    $pwd = 'root';
    $schema = 'store';

    $connection = mysqli_connect($server, $user, $pwd, $schema);

    if (!$connection) {
        // error connecting to db
        die("Error connecting to db ...");
    }

    // to store portuguese characters correctly
    mysqli_set_charset($connection, 'utf8');

?>