<?php
    include('../../src/verifica_login.php');
    include('../../src/conexao.php');
    $uuid = $_SESSION['id'];
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
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script>
        $(function(){
            $("#nav-placeholder").load("../templates/navbar-template.html");
        });
    </script>
</head>
<body>
    <header id="nav-placeholder">

    </header>
    <div id="espacador">

    </div>
    <main>
        <div class="well well-sm">
            <form class="formulario-postar" method="POST" enctype="multipart/form-data"></p>
                <p><textarea type="text" name="descricao" cols="35" rows="6" class="form form-control" placeholder="Descrição"></textarea><br></p>
                <p><input type="file" name="image" id="image" class="form form-control"></p>
                <p><input type="submit" class="botao" value="Postar" class="form form-control"></p>
                <input type="hidden" value="send" name="enviar">
            </form>
            <?php
                if(isset($_POST['enviar']) && isset($_POST['enviar']) == 'send'){
                    date_default_timezone_set('America/Sao_Paulo');
                    $desc = htmlspecialchars($_POST['descricao'], ENT_QUOTES, 'UTF-8');
                    $data_plus_hora = date('d/m/Y')." ".date('H:i');

                    $uploaddir = '../../uploads/images/';
                    $tmp = explode(".",$_FILES["image"]["name"]);
                    $uploadfile = $uploaddir.rand(1,99999) . '.' . end($tmp);


                    if(move_uploaded_file($_FILES['image']['tmp_name'] , $uploadfile)){
                        $sqlpost = "INSERT INTO posts (id_usuario, imagem, descricao, data_e_hora) VALUES ($uuid, '$uploadfile', '$desc', '$data_plus_hora')";
                        $postar = mysqli_query($conexao, $sqlpost);
                    }else{
                        $sqlpost = "INSERT INTO posts (id_usuario, descricao, data_e_hora) VALUES ($uuid, '$desc', '$data_plus_hora')";
                        $postar = mysqli_query($conexao, $sqlpost);
                    }
                    
                }
            ?>

        </div>
        <div class="posts">
            <?php
                if(isset($_GET['posts'])){
                    $pg = (int)$_GET['posts'];
                }else{
                    $pg = 1;
                }
                
                $maximo = 999999*999999;
                $inicio = ($pg * $maximo) - $maximo;

                $seleciona = mysqli_query($conexao, "SELECT * FROM posts ORDER BY id_post DESC LIMIT $inicio, $maximo");
                $conta = mysqli_num_rows($seleciona);
            
                if($conta <= 0){
                    echo '<br><br><br><br><br><code class="texto-comum">Nenhuma Postagem Encontrada</code>';
                }else{
                    while($row = mysqli_fetch_array($seleciona)){
                        $id_post = $row['id_post'];
                        $id_usuario = $row['id_usuario'];
                        $imagem = $row['imagem'];
                        $descricao = $row['descricao'];
                        $data_e_hora = $row['data_e_hora'];
                        $sql = "SELECT * FROM usuarios WHERE id = $id_usuario";
                        $query = mysqli_query($conexao, $sql);
                        $linha = mysqli_fetch_assoc($query);
            ?>
                
            <div class="post">
                <div class="post-profile-info">
                    <img class="post-pfp" src="<?php echo "../".$linha['pfp']?>">
                    <a href="profiles.php?id=<?php echo $linha['id']?>"><h1 class="post-profile-name"><?php echo "@".$linha['usuario']?></h1></a>
                </div>
                <div class="post-content">
                    <p class="texto-comum"><?php echo $descricao?></p>
                    <?php if($imagem != null){?><img src=<?php echo $imagem ?> class="post-media"><?php } ?>
                </div>
                <div class="dateandhour">
                    <p class="smallinfo">Postado em <?php echo $data_e_hora?></p>
                </div>
            </div>

            <?php }}?>
        </div>
        <div class="espacador">

        </div>
    </main>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php
            $seleciona = mysqli_query($conexao,"SELECT * FROM posts");
            $totalPosts = mysqli_num_rows($seleciona);

            $pags = ceil($totalPosts/$maximo);
            $links = 2;

            echo '<li class="page-item">><a class="page-link" href="?pagina=inicio&posts=1" aria-label="Página Inicial"><span aria-hidde="true">&laquo;</span></a></li>';


            for($i = $pg - $links; $i <= $pg -1; $i++){
                    if($i <= 0){}else{
                echo '<li class="page-item"><a class="page-link" href="?pagina=inicio&posts='.$i.'">'.$i.'</a></li>';
            }
        }

            echo '<li class="page-item"><a class="page-link" href="?pagina=inicio&posts='.$pg.'">'.$pg.'</a></li>';

            for($i = $pg + 1; $i <= $pg + $links; $i++)
                if($i > $pags){}else{
                echo '<li class="page-item"><a class="page-link" href="?pagina=inicio&posts='.$i.'">'.$i.'</a></li>';
                }

                echo '<li class="page-item"><a class="page-link" href="?pagina=inicio&posts='.$pags.'" aria-label="Última página"><span aria-hidde="true">&raquo;</span></a></li>';
            ?>
        </ul>
    </nav>
    
</body>
</html>