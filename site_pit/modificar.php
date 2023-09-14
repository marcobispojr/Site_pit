<?php
// Conectar ao banco de dados
$banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");

// Inicializar as variáveis
$problema = null;
$id = "";
$motivo = "";
$local = "";
$bairro = "";
$referencia = "";
$descricao = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Consulta SQL para selecionar os dados do problema com base no ID
        $sql = "SELECT * FROM cadastro_problemas WHERE id = :id";
        $stmt = $banco->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Verifica se o problema com o ID especificado existe
        if ($stmt->rowCount() > 0) {
            $problema = $stmt->fetch(PDO::FETCH_ASSOC);
            // Preencher as variáveis com os valores existentes
            $motivo = $problema['motivo'];
            $local = $problema['localizacao'];
            $bairro = $problema['bairro'];
            $referencia = $problema['ponto_referencia'];
            $descricao = $problema['descricao'];
        } else {
            echo "Problema com ID $id não encontrado.";
            exit;
        }
    } else {
        echo "ID do problema não especificado.";
        exit;
    }
}

if (isset($_POST['atualizar'])) {
    // Receber os novos valores dos campos
    $id = $_POST['id'];
    $motivo = $_POST['motivo'];
    $local = $_POST['local'];
    $bairro = $_POST['bairro'];
    $referencia = $_POST['referencia'];
    $descricao = $_POST['descricao'];

    // Consulta SQL para atualizar os dados do problema com base no ID
    $sql = "UPDATE cadastro_problemas SET motivo = :motivo, localizacao = :local, bairro = :bairro, ponto_referencia = :referencia, descricao = :descricao WHERE id = :id";
    $stmt = $banco->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':motivo', $motivo, PDO::PARAM_STR);
    $stmt->bindParam(':local', $local, PDO::PARAM_STR);
    $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    $stmt->bindParam(':referencia', $referencia, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header("Location: pagina_inicial.php"); // Redirecionar após a atualização
        exit;
    } else {
        echo "Erro ao atualizar o problema com ID $id.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição de Problema</title>
    <link rel="stylesheet" type="text/css" href="assets/css/landing.css">
    <!-- Seus estilos CSS aqui -->
</head>
<body>
    <header>
        <a href="landing_page.html">
            <div class="logo">
                <img src="assets/imagens/engrenagem.png" alt="Logo">
            </div>
        </a>
        <div class="our">
        </div>
    </header>
    <h1>Edição de Problema</h1>
    <form method="POST">
        <div class="form-group">
            <label for="id">ID do Problema:</label>
            <input type="text" id="id" name="id" value="<?php echo $id; ?>" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo da denúncia:</label>
            <input type="text" id="motivo" name="motivo" value="<?php echo $motivo; ?>" required>
        </div>
        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" id="local" name="local" value="<?php echo $local; ?>" required>
        </div>
        <div class="form-group">
            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" value="<?php echo $bairro; ?>" required>
        </div>
        <div class="form-group">
            <label for="referencia">Ponto de referência:</label>
            <input type="text" id="referencia" name="referencia" value="<?php echo $referencia; ?>" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição da denúncia:</label>
            <textarea id="descricao" name="descricao" rows="5" required><?php echo $descricao; ?></textarea>
        </div>
        <input class="submit-btn" type="submit" name="atualizar" value="Atualizar">
    </form>
</body>
</html>
