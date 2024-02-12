<?php
session_start();
if (empty($_SESSION["user_id"])) {
    print "<script>location.href='dashboard.php';</script>";
    exit();
}

// Se conecta com o banco de dados
$conn = new mysqli("localhost", "root", "", "sislogin");

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados" . $conn->connect_error);
}

$userId = $_SESSION["user_id"]; // Suponha que você tenha armazenado o ID do usuário na sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskName = $_POST["task_name"];

    // Inserir nova tarefa associada ao usuário logado
    $insert_sql = "INSERT INTO tasks (task_name, user_id) VALUES ('$taskName', '$userId')";
    $conn->query($insert_sql);
    header("Location: dashboard.php"); // Redirecionar após adicionar a tarefa
    exit();
}
?>
<!-- Restante do seu HTML para a página add_task.php -->