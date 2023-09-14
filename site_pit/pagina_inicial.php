<?php
// Conectar ao banco de dados
$banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");

// Consulta SQL para selecionar os dados da tabela (substitua 'sua_tabela' pelo nome da sua tabela real)
$sql = "SELECT * FROM cadastro_problemas";
$resultado = $banco->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Conectar ao banco de dados
        $banco = new PDO("mysql:host=localhost;dbname=pit", "root", "soneto2005");

        // Consulta SQL para excluir o registro com base no ID
        $sql = "DELETE FROM cadastro_problemas WHERE id = :id";

        // Preparar e executar a consulta
        $stmt = $banco->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "Registro com ID $id excluído com sucesso.";
        } else {
            echo "Erro ao excluir o registro com ID $id.";
        }
    } else {
        echo "ID do registro não especificado.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/landing.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .enviado {
            background-color: yellow; /* Define a cor de fundo para amarelo */
        }
    </style>
</head>
<body>
<header>
    <a href="landing_page.html">
        <div class="logo">
            <img src="assets/imagens/engrenagem.png" alt="Logo">
        </div>
    </a>
    <div class="our">
        <p><a href="cadastro_problema.php" style="text-decoration: none;">Cadastrar novo problema</a></p>
        <p><a href="modificar.php" style="text-decoration: none;">Modificar Reclamação</a></p> 
    </div>
</header>

    <div>
    <h3>Excluir Registro</h3>
    <form action="pagina_inicial.php" method="POST">
        <label for="id">ID do Registro a Excluir:</label>
        <input type="text" name="id" id="id" required>
        <input type="submit" value="Excluir">
    </form>

        <h2>Reclamações Feitas</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>motivo</th>
                    <th>localizacao</th>
                    <th>bairro</th>
                    <th>ponto_referencia</th>
                    <th>descricao</th>
                    <th>Status</th>
                    <!-- Adicione mais cabeçalhos de coluna conforme necessário -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop através dos resultados e exiba-os na tabela
                while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>"; 
                    echo "<td>" . $row['motivo'] . "</td>"; 
                    echo "<td>" . $row['localizacao'] . "</td>"; 
                    echo "<td>" . $row['bairro'] . "</td>"; 
                    echo "<td>" . $row['ponto_referencia'] . "</td>"; 
                    echo "<td>" . $row['descricao'] . "</td>"; 
                    
                    // Verificar o valor da coluna 'Status' e adicionar a classe CSS 'enviado' ao fundo da célula se for 'enviado'
                    if ($row['Status'] == 'enviado') {
                        echo "<td class='enviado'>" . $row['Status'] . "</td>";
                    } else {
                        echo "<td>" . $row['Status'] . "</td>";
                    }
                    
                    // Adicione mais colunas conforme necessário
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
</body>
</html>

