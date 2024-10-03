<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);

    $database = new Database('localhost', 'escola', 'thiago', '123456');
    $database->connect();
    $conn = $database->getConnection();

    $stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header('Location: index.php');
    } else {
        echo "Erro ao excluir dados: " . $stmt->error;
    }
}
?>

