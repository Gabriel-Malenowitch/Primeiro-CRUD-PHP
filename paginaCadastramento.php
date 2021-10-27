<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="styleCadastro.css">
    <title>Document</title>
</head>

<body>

    <?php
        $pdo = new PDO('mysql:localhost; dbname:contatos', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    ?>
    <?php
        if(isset($_GET['nome']) && (isset($_COOKIE['atualizar'])||$_COOKIE['atualizar']!='')){
            $id = (int) $_COOKIE['atualizar'];
            $nome = $_GET['nome'];
            $telefone = $_GET['telefone'];
            $email = $_GET['email'];
            $sql = $pdo->exec("update contatos.contatos set nome='$nome' where id='$id'");
            $sql = $pdo->exec("update contatos.contatos set telefone='$telefone' where id='$id'");
            $sql = $pdo->exec("update contatos.contatos set email='$email' where id='$id'");
            setcookie("atualizar", "", time()-3600);
            echo '<meta http-equiv="refresh" content="0; url=index.php">';
        }
        else{
            if(isset($_GET['nome'])){
                $sql = $pdo->prepare('insert into contatos.contatos values (null, ?, ?, ?)');
                $sql->execute(array($_GET['nome'], $_GET['telefone'], $_GET['email'])); 
                echo '<meta http-equiv="refresh" content="0; url=index.php">';
            }
        }
    ?>
    <main class="conteudo" id="conteudo">
        <div class="container" id="container">
            <h1>Gostou do que viu? Se cadastre conosco.</h1>
        
            <form class="formulario" method="GET">
                <div class="nome">
                    <label for="name" id="nome">Nome Completo<br></label>
                    <input type="text" name="nome" id="name" placeholder="Nome">
                </div>

                <div class="phone">
                    <label for="phone" id="phone">Telefone<br></label>
                    <input type="tel" name="telefone" id="phone" placeholder="Numero de telefone">
                </div>

                <div class="email">
                    <label for="email" id="email">E-mail<br></label>
                    <input type="email" name="email" id="email" placeholder="Email">
                </div>
                <button type="submit" class="botao">Cadastrar</button>
            </form>
        </div>

    </main>
</body>

</html>