<?php
header('Content-Type: text/html; charset=utf-8');
$resultado = "";

if (isset($_POST['enviar'])) {
    $banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_login = $_POST['tipo_login'];

    $tabela = ($tipo_login == 'usuario') ? 'usuarios' : 'funcionarios';

    $sql = "SELECT * FROM $tabela WHERE Email = :email AND senha = :senha";
    $stmt = $banco->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Login bem-sucedido
        if ($tipo_login == 'funcionario') {
            // Se for um funcionário, redirecione para a página de acesso interno
            header("Location: acesso_interno.php");
            exit();
        } else {
            // Se for um usuário regular, redirecione para a página inicial
            header("Location: pagina_inicial.php");
            exit();
        }
    } else {
        $resultado = "FALHA NO LOGIN";
        echo ($resultado);
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
            <h1 class="mb-5">Login</h1>
            <form class="" action="" method="POST">
                <label for="">Email</label>
                <input class="form-control mb-3" type="email" name="email">
                <label for="">Senha</label>
                <input class="form-control mb-3" type="password" name="senha">
                
                <!-- Adicione um menu suspenso (select) para escolher o tipo de login -->
                <label for="">Tipo de Login</label>
                <select class="form-control mb-3" name="tipo_login">
                    <option value="usuario">Usuário</option>
                    <option value="funcionario">Funcionário</option>
                </select>
                
                <a class="mb-3" href="#">Esqueceu sua senha?</a>
                <input class="ButtonLogar form-control" type="submit" value="Logar" name="enviar">
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
