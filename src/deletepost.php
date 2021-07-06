<?php
session_start();
include('conexao.php');
$id_usr = $_SESSION['id'];
$id_post = $_GET['id'];

$seleciona = mysqli_query($conexao, "SELECT * FROM posts WHERE id_usuario = $id_usr AND id_post = $id_post");

$resultado = mysqli_num_rows($seleciona);

if($resultado > 0){
    $sql = mysqli_query($conexao, "DELETE FROM posts WHERE id_post = $id_post");
}


if($sql){
    header("location: ../public/pages/myprofile.php");
}else{
    echo 'ocorreu um erro ao deletar a postagem, acesso negado';
}