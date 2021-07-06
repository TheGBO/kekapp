<?php
    if(isset($_COOKIE['email']) && isset($_COOKIE['senha'])){
    include('../../src/conexao.php');
    session_start();

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

        

        header("location: home.php");

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
    /*else{
        alguma coisa
    }*/

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KekApp</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <img src="../img/kakapo_logo2.png" class="logo-image" alt="logo" class="logo">
            <div class="mobile-menu">
              <div class="line1"></div>
              <div class="line2"></div>
              <div class="line3"></div>
            </div>
            <ul class="nav-list">

            </ul>
          </nav>
    </header>
    <main>
        <div class="spacingup">
            
        </div>
        <div class="menuindex">
            <ul class="ronaldo">
                <li><p class="texto-comum">Novo No KekApp?</p></li>
                <li><a href="cadastro.php" class="botaolindo">Criar Conta</a></li>
                <br><br><br><br><br><br>
                <li><p class="texto-comum">Já possui uma conta?</p></li>
                <li><a href="login.php" class="botaolindo">Entrar</a></li>
            </ul>
        </div>
        
    </main>
</body>
</html>