<?php
header('Content-Type: text/html; charset=utf-8');
$erro = "";

if (isset($_POST['enviar'])) {
  $banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");
  $Email = $_POST['email'];
  $senha = $_POST['senha'];
  $nome = $_POST['nome'];
  $cpf = $_POST['cpf'];
  $cep = $_POST['cep'];

  if ($senha != $Email) {
    $insert = $banco->prepare("INSERT INTO usuarios(Email, Senha, Nome, Cpf, Cep) VALUES(?,?,?,?,?)");
    $insert->execute([$Email, $senha, $nome, $cpf, $cep]);
    header("Location: landing_page.html");
    exit();
    } else if ($senha != $confirma) {
        echo ("FALHA NO CADASTRO!");
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/css/login.css'>
    </head>
<body>
    <div class="Alinhamento">
        <div class="login">
            <h1 class="mb-5">Cadastre-se</h1>
            <form class="" action="" method="POST">
                <label for="">Email</label>
                <input class="form-control mb-3" type="email" name="email">
                <label for="">Senha</label>
                <input class="form-control mb-3" type="password" name="senha">
                <label for="">Nome</label>
                <input class="form-control mb-3" type="text" name="nome">
                <label for="">CPF</label>
                <input class="form-control mb-3" type="text" name="cpf">
                <label for="">CEP</label>
                <input class="form-control mb-3" type="text" name="cep">
                <a class="mb-3" href="#">
                    Esqueceu sua senha?
                </a>
                <input class="ButtonLogar form-control" type="submit" value="Cadastre-se" name="enviar">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>