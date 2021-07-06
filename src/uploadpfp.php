<?php
session_start();
$uid = $_SESSION['id'];
include('conexao.php');

$bio = $_POST['biografia'];
$_SESSION['bio'] = $bio;

if(isset($_POST['enviar']) && isset($_POST['enviar']) == 'send'){

    $sql = "UPDATE usuarios SET biografia = '$bio' WHERE id = $uid";
    mysqli_query($conexao, $sql);

    $uploaddir = '../uploads/profilepics/';
    $tmp = explode(".",$_FILES["profileImage"]["name"]);
    $uploadfile = $uploaddir.rand(1,99999).time(). '.' . end($tmp);


    if(move_uploaded_file($_FILES['profileImage']['tmp_name'] , $uploadfile)){
        $sql = "UPDATE usuarios SET pfp = '$uploadfile' WHERE id = $uid";
        $postar = mysqli_query($conexao, $sql);
        $_SESSION['pfp'] = $uploadfile;
        header("location: ../public/pages/myprofile.php");
    }else{
        header("location: ../public/pages/myprofile.php");
    }
}