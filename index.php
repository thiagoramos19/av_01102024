<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>
    <link rel="stylesheet" href="css/style.css">
    <?php
        // sempre inciando o arquivo com a conexão
        require_once 'db.php';
        $database = new Database('localhost', 'escola', 'thiago', '123456');
        $database->connect();
        $pdo = $database->getConnection(); //conexão para usar nas consultas
    ?>
</head>
<body>
    <!-- formulário para cadastro -->
    <div id="box">
        <form action="cadastro.php" method="GET">
            <label for="nome">Nome:</label><br>
            <input type="text" id="nome" name="nome" required><br><br>

            <label for="idade">Idade:</label><br>
            <input type="number" id="idade" name="idade" required><br><br>

            <label for="email">E-mail:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="curso">Curso:</label><br>
            <input type="text" id="curso" name="curso" required><br><br>

            <!-- botão de enviar -->
            <input type="submit" value="Enviar">
        </form>
    </div>

    <!-- listagem dos alunos -->
    <div id="lista">
        <h2>Alunos:</h2>
        <table id="Alunos">
            <?php
                // pega os dados da tabela 'alunos'
                $stmt = $pdo->query("SELECT id, nome, idade, email, curso FROM alunos");

                if ($stmt->num_rows > 0) { // se tiver alunos cadastrados, mostra a tabela
                    echo "<thead><tr><th>Nome</th><th>Idade</th><th>E-mail</th><th>Curso</th><th>Ação</th></tr></thead><tbody>";
                    while ($row = $stmt->fetch_assoc()) {
                        $id = $row['id'];
                        $nome = $row['nome'];
                        $idade = $row['idade'];
                        $email = $row['email'];
                        $curso = $row['curso'];

                        // botão para excluir alunos é adicionado como link
                        echo "<tr>
                                <td>$nome</td>
                                <td>$idade</td>
                                <td>$email</td>
                                <td>$curso</td>
                                <td><a href='delete.php?id=$id' class='delete-btn'>Excluir</a></td> 
                              </tr>";
                    }
                    echo "</tbody>";
                } else {
                    echo "Nenhum dado encontrado."; // se não tem aluno, manda esse aviso
                }
            ?>
        </table>
    </div>
</body>
</html>
