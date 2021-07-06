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
        <form action="../../src/cadastrar.php" method="POST" class="formulario-postar">
            <label>Nome</label>
            <input type="text" name="nome" class="credentials">
            <label>E-Mail</label>
            <input type="email" name="email" class="credentials">
            <label>Senha</label>
            <input type="password" name="senha" class="credentials">
            <input type="submit" class="botao" value="Cadastrar">
        </form>
    </main>
</body>
</html>