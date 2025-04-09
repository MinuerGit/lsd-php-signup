<?php
    // Set up connection to db
    $server = 'localhost'; // 127.0.0.1 is the same as localhost

    $user = 'root'; // Nome do User que está a aceder a base de dados
    $pwd = 'root';  // Palavra Passe da Base de dados, este é exemplo, na realidade isto
    // têm varios credenciais
    $schema = 'store'; // base de dados a utilizar 

    $connection = mysqli_connect($server, $user, $pwd, $schema);

    if (!$connection) {
        // error connecting to db
        die("Error connecting to database ...");
    }

    // to store portuguese characters correctly
    mysqli_set_charset($connection, 'utf8');

?>

