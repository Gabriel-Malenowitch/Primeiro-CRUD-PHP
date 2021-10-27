<?php
session_start(); //comando utilizado inicialização do $_SESSION

if (!isset($_SESSION["USUARIO"])) {
    //redirecionar para o login
    header("Location: formulario.php");
}
//ISSET - verifica se uma varíavel existe, se ela foi declarada. 
//(!isset) - se NÃO existir, ou seja, o ! serve para negação, ele irá redirecionar para o login
//$_SESSION["USUARIO"] - Verificação se o usuario está logado. É uma verificação BOOLEANA.

?>
<?php
    $pdo = new PDO('mysql:localhost; dbname:contatos', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="styleContatos.css">
    <title>Contatos</title>
</head>
<body>
    <header class="cabecalho" id="cabecalho">
        <h1>Usuários Cadastrados</h1>
    </header>
    <main class="conteudo" id="conteudo">
        <section class="usuariosCadastrados" id="usuariosCadastrados">
            <table class="tabelaCadastros" id="tabelaCadastros">
                <div class="tHead" id="tHead">
                    <thead>
                        <tr>
                            <td>Delete</td>
                            <td>Atualizar</td>
                            <td>Nomes</td>
                            <td>Telefone</td>
                            <td>Gmail</td>
                        </tr>
                    </thead>
                </div>
                <div class="tBody" id="tBody">
                    <tbody>
                        <?php
                            if(isset($_GET['deletar'])){
                                $id = (int) $_GET['deletar'];
                                $sql = $pdo->exec("delete from contatos.contatos where id=$id");
                            }
                            if(isset($_GET['atualizar'])){
                                setcookie('atualizar', $_GET['atualizar'], time() + 300);
                                echo '<meta http-equiv="refresh" content="0; url=paginaCadastramento.php">';
                            }

                            try{
                                $sql = $pdo->prepare('select * from contatos.contatos');
                                $sql->execute();
                                $data = $sql->fetchAll();
                                foreach($data as $key=>$value){
                                    echo'<tr>
                                            <td><a href="?deletar=',$value['id'],'">deletar</a></td>
                                            <td><a href="?atualizar=',$value['id'],'">atualizar</a></td>
                                            <td>',$value['nome'],'</td>
                                            <td>',$value['telefone'],'</td>
                                            <td>',$value['email'],'</td>
                                        </tr>';
                                }
                            }catch (\Throwable $th){
                                echo '<tr>Nenhum contato!</tr>';
                            }
                            ?>
                    </tbody>
                </div>
            </table>
        </section>
    </main>
    <a id="buttonAdd" href="paginaCadastramento.php">+</a>
    <a id="logoff" href="formulario.php?acao=logoff">LogOff</a>

</body>

</html>