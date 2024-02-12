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
 
// Lógica de pesquisa
$search_query = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search_query = $_GET['search'];
    $search_sql = "SELECT * FROM tasks WHERE user_id = $userId AND task_name LIKE '%$search_query%'";
} else {
    $search_sql = "SELECT * FROM tasks WHERE user_id = $userId ORDER BY created_at DESC";
}
 
$result = $conn->query($search_sql);
 
// Função de particionamento para o Quick Sort
function partition(&$array, $low, $high) {
    $pivot = $array[$high];
    $i = $low - 1;
 
    for ($j = $low; $j < $high; $j++) {
        if ($array[$j]["created_at"] > $pivot["created_at"]) {
            $i++;
            // Troca array[$i] e array[$j]
            $temp = $array[$i];
            $array[$i] = $array[$j];
            $array[$j] = $temp;
        }
    }
 
    // Troca array[$i + 1] e array[$high] (pivot)
    $temp = $array[$i + 1];
    $array[$i + 1] = $array[$high];
    $array[$high] = $temp;
 
    return $i + 1;
}
 
// Função Quick Sort
function quickSort(&$array, $low, $high) {
    if ($low < $high) {
        $partitionIndex = partition($array, $low, $high);
 
        // Ordena os elementos antes e depois do índice de partição
        quickSort($array, $low, $partitionIndex - 1);
        quickSort($array, $partitionIndex + 1, $high);
    }
}
 
// Verifica se há resultados antes de ordenar
if ($result->num_rows > 0) {
    // Converte os resultados para um array associativo
    $tasksArray = [];
    while ($row = $result->fetch_assoc()) {
        $tasksArray[] = $row;
    }
 
    // Aplica o Quick Sort no array de tarefas
    quickSort($tasksArray, 0, count($tasksArray) - 1);
}
 
$conn->close();
?>
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gerênciador de Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
<style>
        *{
            font-family: 'Bree Serif', serif;
        }
        @media (max-width: 768px) {
            .navbar-text {
                display: none;
            }
        }
 
        list-group-item {
            position: relative;
        }
 
        .list-group-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
 
        .task-actions {
            flex-shrink: 0;
            margin-left: 10px; /* Ajuste o valor conforme necessário para dar espaço aos botões */
        }
</style>
</head>
 
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <div class="text-center">
                <img src="./imagens/logo.png" alt="" class="img-fluid" style="max-width: 150px;">
            </div>

            <?php
                print "<span class='navbar-text hidden-xs'>Olá, " . $_SESSION["nome"] . "!</span>";
                print "<a href='logout.php' class='btn btn-danger'>Sair</a>";
            ?>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="display-3">Lista de Tarefas</h1>
            <form action="" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Pesquisar por tarefa" value="<?php echo $search_query; ?>">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            </form>

            <ul class="list-group mt-3">
            <?php
                        if (!empty($tasksArray)) {
                            foreach ($tasksArray as $row) {
                                echo "<li class='list-group-item'>
                                        <span class='flex-fill'>" . $row["task_name"] . "</span>" .
                                        "<div class='task-actions'>
                                        <a href='edit_task.php?id=" . $row["id"] . "' class='btn btn-primary btn-sm ms-1'>Editar</a>" .
                                        "<a href='remove_task.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm ms-1'>Deletar</a>
                                        </div>
                                        </li>";
                            }
                        } else {
                            echo "<li class='list-group-item'>Nenhuma tarefa encontrada</li>";
                        }
                        ?>
            </ul>

            <h2 class="mt-5 text-left">Adicionar Tarefa:</h2>
                <form action="add_task.php" method="post" class="mb-5 d-flex justify-content-center">
                    <div class="input-group">
                        <input type="text" name="task_name" class="form-control" placeholder="Nome da tarefa" required>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
                                    </svg>
                                        </i>Adicionar Tarefa
                            </button>
                    </div>
                </form>
    </div>
</body>
</html>