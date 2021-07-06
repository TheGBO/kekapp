<?php
include('conexao.php');
session_start();
print_r($_COOKIE);
echo $_COOKIE;
var_dump($_COOKIE);

if(isset($_COOKIE['email']) && isset($_COOKIE['senha'])){
    $email = mysqli_real_escape_string($conexao, base64_decode($_COOKIE['email']));
    $senha = mysqli_real_escape_string($conexao, base64_decode($_COOKIE['senha']));
}else{
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
}



$query = "select * from usuarios where email = '$email' and senha = md5('$senha')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

$get_info = "select * from usuarios where email = '$email' and senha = md5('$senha')";
$info_result = mysqli_query($conexao,$get_info);
$con = $conexao->query($get_info) or die($conexao->error);

if($row == 1){
    $_SESSION['email'] = $email;

    

    header("location: ../public/pages/home.php");

    while ($dado = $con->fetch_array()) {
        $_SESSION['id'] = $dado['id'];
        $_SESSION['pfp'] = $dado['pfp'];
        $_SESSION['usuario'] = $dado['usuario'];
        $_SESSION['bio'] = $dado['biografia'];
    }
    $uid = $_SESSION['id'];
    
    $get_pfp = "select pfp from usuarios where id = $uid";
    $pfp_result = mysqli_query($conexao,$get_pfp);
    setcookie("email", base64_encode($email), time() + (10 * 365 * 24 * 60 * 60), '/');
    setcookie("senha", base64_encode($senha), time() + (10 * 365 * 24 * 60 * 60), '/');
    $conpfp = $conexao->query($get_pfp) or die($conexao->error);
}
else{
    header("location: ../public/pages/login.php");
}
