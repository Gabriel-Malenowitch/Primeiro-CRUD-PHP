<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testando Avaliativa 1</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="global.css">
</head>

<body>
    <style>
        body {
            background-color: lightblue;
        }

        h1 {
            text-align: center;
            font-family: 'Courier New', Courier, monospace;
            text-decoration: underline;
            font-size: 350%;
        }
        div#loginTexto, #senhaTexto {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 130%;
        }
    </style>

    <div class="container">
        <h1>Autenticação de Usuário</h1>

        <form action="formulario.php" method="post">

            <div class="mb-3" id="loginTexto">
                <label for="login" class="form-label">Login:</label>
                <input type="text" name="login" id="login" class="form-control">
            </div>

            <div class="mb-3" id="senhaTexto">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control">
            </div>

            <input type="submit" value="Log In" class="btn btn-success">

        </form>

        <?php
        session_start();
        define("LOGIN", "admin");
        define("SENHA", "admin");

        //testar se minha requisição está vindo do POST
        if ($_SERVER["REQUEST_METHOD"] == 'POST') {
            if (isset($_POST["login"]) && isset($_POST["senha"])) {
                $login = $_POST["login"];
                $senha = $_POST["senha"];
                if ($login == LOGIN && $senha == SENHA) {
                    //logado
                    $_SESSION["USUARIO"] = "Admin";
                    header("Location: index.php");
                } else {
                    echo "<br>Login ou Senha incorretos.";
                }
            }
        }

        if (isset($_GET["acao"])) {
            $acao = $_GET["acao"];
            if ($acao == "logoff") {
                session_destroy();
            }
        }

        ?>
    </div>

</body>

</html>