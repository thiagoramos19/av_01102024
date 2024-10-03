<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação</title>
    <?php
        // Conecta com o banco (mesma vibe do index.php)
        require_once 'db.php';
        $database = new Database('localhost', 'escola', 'thiago', '123456');
        $database->connect();
        $pdo = $database->getConnection();
    ?>
</head>
<body>
<?php
// Verifica se o form mandou os dados certinhos
if (isset($_GET['nome']) && isset($_GET['idade']) && isset($_GET['email']) && isset($_GET['curso'])) {
    // Pega os dados do form e protege contra injeção com htmlspecialchars
    $nome = htmlspecialchars($_GET['nome']);
    $idade = htmlspecialchars($_GET['idade']);
    $email = htmlspecialchars($_GET['email']);
    $curso = htmlspecialchars($_GET['curso']);

    // Se a conexão tá de boas, bora inserir no banco!
    if ($pdo) {
        try {
            // Insere os dados no banco. "?" são placeholders pra prevenir injeção de SQL
            $stmt = $pdo->prepare("INSERT INTO alunos (nome, idade, email, curso) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siss", $nome, $idade, $email, $curso);
           
            // Se tudo der certo, redireciona de volta pro index.php
            if ($stmt->execute()) {
                header('Location: index.php');
            } else {
                echo "Erro ao inserir dados: " . $stmt->error;
            }
        } catch (Exception $e) {
            // Se der ruim, mostra o erro (sem explodir tudo, claro)
            echo "Erro ao consultar o banco de dados: " . $e->getMessage() . "<br>";
        }
    }
} else {
    // Se não vier nada no form, só avisa que tá faltando dado.
    echo "Nenhum dado foi enviado.";
}
?>
</body>
</html>

