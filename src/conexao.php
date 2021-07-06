<?php
    define('HOST','127.0.0.1');
    define('USUARIO', 'root');
    define('SENHA', 'Adtv4465+');
    define('DB', 'kekapp');

    $conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die('não foi possivel efetuar a conexão');
?>