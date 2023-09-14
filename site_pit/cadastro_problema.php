<?php
header('Content-Type: text/html; charset=utf-8');
$erro = "";

if (isset($_POST['enviar'])) {
    $banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");
    $motivo = $_POST['motivo'];
    $local = $_POST['local'];
    $bairro = $_POST['bairro'];
    $referencia = $_POST['referencia'];
    $descricao = $_POST['descricao'];
    $foto = $_POST['foto'];

    // Adicione o valor 'enviado' à coluna 'status'
    $status = 'enviado';

    $insert = $banco->prepare("INSERT INTO cadastro_problemas(motivo, localizacao, bairro, ponto_referencia, descricao, foto, status) VALUES(?,?,?,?,?,?,?)");
    $insert->execute([$motivo, $local, $bairro, $referencia, $descricao, $foto, $status]);
    
    // Redirecionar para a página "pagina_inicial.php"
    header("Location: pagina_inicial.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Problemas</title>
    <link rel="stylesheet" type="text/css" href="assets/css/landing.css">
    <style>
        * {
    box-sizing: border-box;
  }
  
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    background-color: #f2f2f2;
    display: flex;
    width: 100%;
    flex-direction: column;
  }
  
  .form-group {
    margin-bottom: 20px;
  }

  form{
    width: 60%;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
  }
  
  input[type="text"],
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    background-color: #fff;
    color: #555;
  }
  
  input[type="file"] {
    display: none;
  }
  
  .custom-file-upload {
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
    background-color: #F8A200;
    color: white;
    border-radius: 4px;
  }
  
  .submit-btn {
    padding: 10px 20px;
    background-color: #F8A200;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  h1 {
    margin-bottom: 20px;
    text-align: center;
    color: #333;
  }

.formulario {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f2f2f2;
    display: flex;
    width: 100%;
    flex-direction: column;
    align-items: center;
}

    </style>
</head>

<body>
<header>
        <!-- Use um elemento de âncora <a> em torno da imagem da logo para o redirecionamento -->
        <a href="pagina_inicial.php">
            <div class="logo">
                <img src="assets/imagens/engrenagem.png" alt="Logo">
            </div>
        </a>
        <div class="our">
</div>
    </header>
    <h1>Cadastro de Problemas</h1>
<div class='formulario'>
    <form method="POST">
        <div class="form-group">
            <label for="motivo">Motivo da denúncia:</label>
            <input type="text" id="motivo" name="motivo" required>
        </div>

        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" id="local" name="local" required>
        </div>

        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" required>
        </div>

        <div class="form-group">
            <label for="referencia">Ponto de referência:</label>
            <input type="text" id="referencia" name="referencia" required>
        </div>

        <div class="form-group">
            <label for="descricao">Descrição da denúncia:</label>
            <textarea id="descricao" name="descricao" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label for="foto">Foto do local (Formatos permitidos: jpg, jpeg, png):</label>
            <input type="file" id="foto" name="foto" accept="image/jpeg, image/png">
            <label class="custom-file-upload" for="foto">Selecionar foto</label>
        </div>

        <input class="submit-btn" type="submit" name="enviar">
    </form>
</div>

</body>

</html>