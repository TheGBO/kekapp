<?php
include('../../src/verifica_login.php');
$pfpurl = $_SESSION['pfp'];
$username = $_SESSION['usuario'];
$uuid = $_SESSION['id'];
$bio = $_SESSION['bio'];
include('../../src/conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KekApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header id="nav-placeholder"></header>
    <main style="margin-top: 12vh;">
        <div class="profile-box">
            
            <img class="pfp" src="<?php echo "../".$pfpurl; ?>">
            <h1 class="texto-comum-grande"><?php echo $username; ?> </h1>
            <p class="texto-pequeno"><?php echo $bio ?></p>
            
        </div>
        <div class="profile-box">
            <h1 class="texto-comum">Configurações do perfil</h1>
            <a onclick="mostrar()" class="material-icons" id="engrenagem">settings</a>
            <div id="profile-settings">
            <form action="../../src/uploadpfp.php" method="POST" enctype="multipart/form-data">
                <label class="texto-comum">Foto De Perfil:</label><br>
                <input type="file" name="profileImage">
                <input type="hidden" value="send" name="enviar">
                <br>
                <br>            
                <hr>
                <p><textarea type="text" name="biografia" cols="35" rows="6" class="form form-control" placeholder="Diga Algo Sobre Você"></textarea><br></p>
                <input type="submit" value="Atualizar Perfil"><br>
            </form>
        </div>
        </div>

        <div class="profile-box">
            <h1 class="texto-comum">Suas Postagens</h1>
            <a onclick="mostrar2()">
                <span id="seta" class="material-icons texto-comum-grande">list</span> 
            </a>
            <div id="profile-posts">
            <?php 
                    $sql = "SELECT * FROM posts WHERE id_usuario = $uuid";
                    $resultado = mysqli_query($conexao, $sql);

                    while($row = mysqli_fetch_array($resultado)){
                        $id_post = $row['id_post'];
                        $id_usuario = $row['id_usuario'];
                        $imagem = $row['imagem'];
                        $descricao = $row['descricao'];
                        $data_e_hora = $row['data_e_hora'];
                        $sqlt = "SELECT * FROM usuarios WHERE id = $id_usuario";
                        $query = mysqli_query($conexao, $sqlt);
                        $linha = mysqli_fetch_assoc($query);
                    ?>
                        <div class="post" id="<?php echo $id_post; ?>">
                            <div class="post-profile-info">
                                <img class="post-pfp" src="<?php echo "../".$linha['pfp']?>">
                                <a href=""><h1 class="post-profile-name"><?php echo "@".$linha['usuario']?></h1></a>
                            </div>
                            <div class="post-content">
                                <p class="texto-comum"><?php echo $descricao?></p>
                                <?php if($imagem != null){?><img src=<?php echo $imagem ?> class="post-media small-image"><?php } ?>
                            </div>
                            <a class="deletar" onclick="deleta(<?php echo $id_post;?>)"><span class="material-icons">delete</span>excluir postagem</a>
                        </div>
                    <?php } ?>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        function deleta(id){
            let deletarid = id;
            $.ajax({
                url: "../../src/deletepost.php?id="+id,
                if (reload_on_return) {
                setTimeout(
                  function() 
                  {
                     location.reload();
                  }, 0001);    
                },
                
            });
            $(`#${deletarid}`).remove();
        }
        

    </script>
    <script>
        $(function(){
            $("#nav-placeholder").load("../templates/navbar-template.html");
        });
    </script>
    <script src="../scripts/toggle-profile-settings.js"></script>
</body>
</html>