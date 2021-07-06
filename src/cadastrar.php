<?php
session_start();
include('conexao.php');
if($_POST != " " || $_POST != ""){
    $usuario = mysqli_real_escape_string($conexao,trim($_POST['nome']));
    $email = mysqli_real_escape_string($conexao,trim($_POST['email']));
    $senha = mysqli_real_escape_string($conexao,trim(md5($_POST['senha'])));

    $sql = "select count(*) as total from usuarios where email = '$email'";

    $result = mysqli_query($conexao,$sql);

    $row = mysqli_fetch_assoc($result);

    if($row['total'] == 1){
        $_SESSION['email_existe'] = true;
        header('location: ../public/pages/cadastro.php');
        exit;
    }

    $sql = "INSERT INTO usuarios (usuario, email, senha, pfp) VALUES ('$usuario','$email','$senha','../uploads/profilepics/pfp-placeholder.png')";

    if($conexao->query($sql) === TRUE){
        $_SESSION['status_cadastro'] = true;
    }

    $conexao->close();

    header('location: ../public/pages/login.php');
}
else{
    echo '<script>window.alert("preencha todos os campos!")</script>';
}
?>