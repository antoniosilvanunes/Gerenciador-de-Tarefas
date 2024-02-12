<?php
session_start();
if (empty($_SESSION)) {
    print "<script>location.href='dashboard.php';</script>";
}
 
// Conectar ao banco de dados
$conn = new mysqli("localhost", "root", "", "sislogin");
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados" . $conn->connect_error);
}
 
// Recuperar o ID da tarefa da URL
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
 
    // Consulta para recuperar os detalhes da tarefa
    $sql = "SELECT * FROM tasks WHERE id = $task_id";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
 
        // Verificar se o formulário foi enviado para processamento
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Processar as alterações e atualizar no banco de dados
            $new_task_name = $_POST['new_task_name'];
 
            $update_sql = "UPDATE tasks SET task_name = '$new_task_name' WHERE id = $task_id";
            if ($conn->query($update_sql) === TRUE) {
                // Redirecionar de volta para a página principal após a edição
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Erro ao atualizar a tarefa: " . $conn->error;
            }
        }
    } else {
        echo "Tarefa não encontrada.";
    }
} else {
    echo "ID da tarefa não fornecido.";
}
 
$conn->close();
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
</head>
<header>
   
</header>
 
<body class="body_edit_task">
    <div class="container mt-5">
        <h1 class="display-3">Editar Tarefa</h1>
 
        <!-- Formulário de Edição -->
        <form action="" method="post" class="mt-3">
            <div class="mb-3">
                <label for="new_task_name" class="form-label">Nome da Tarefa</label>
                <input type="text" name="new_task_name" class="form-control" id="new_task_name" value="<?php echo $task['task_name']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>