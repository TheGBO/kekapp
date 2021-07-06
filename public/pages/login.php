<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KekApp</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    <?php
    session_start();
    if(isset($_SESSION['status_cadastro'])){
        echo '<div class="alert alert-info" role="alert">
            Cadastro Efetuado Com Sucesso, agora insira as informações que você cadastrou para entrar na sua conta!
        </div>';
    }
    ?>
        

        <form action="../../src/logar.php" method="POST" class="formulario-postar" style="margin-top: 0vh;">
            <label>E-Mail</label>
            <input type="email" name="email" class="credentials">
            <label>Senha</label>
            <input type="password" name="senha" class="credentials">
            <input type="submit" class="botao" value="Entrar">
        </form>
    </main>
</body>
</html>