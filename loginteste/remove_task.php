<?php
session_start();
if (empty($_SESSION)) {
    header("Location: dashboard.php");
    exit;
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $task_id = $_GET['id'];

    $conn = new mysqli("localhost", "root", "", "sislogin");

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados" . $conn->connect_error);
    }

    // Query para deletar a tarefa com o ID correspondente
    $sql = "DELETE FROM tasks WHERE id = $task_id";

    if ($conn->query($sql) === TRUE) {
        $success_message =  $_SESSION["nome"] . " sua tarefa foi removida com sucesso!" ;
    } else {
        $error_message = "Erro ao remover tarefa: " . $conn->error;
    }

    $conn->close();
} else {
    $error_message = "ID da tarefa não fornecido";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: white;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="text-center fs-5 mb-5">
        <?php
        if (isset($success_message)) {
            echo $success_message;
        } elseif (isset($error_message)) {
            echo $error_message;
        }
        ?>
    </div>
    <div>
        <a href="dashboard.php" class="btn btn-primary">OK</a>
    </div>
</body>
</html>