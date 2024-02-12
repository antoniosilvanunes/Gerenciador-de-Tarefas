<?php
include("config.php");

$nome = $_POST["nome"];
$email = $_POST["email"];
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

$sql = "INSERT INTO usuarios (nome, email, usuario, senha) VALUES ('$nome', '$email','$usuario','$senha')";

if (mysqli_query($conn, $sql)) {
    $mensagem_sucesso = "<div class='container text-center mt-5'>
                            <h1>Cadastro realizado com sucesso!</h1>
                        </div>";
} else {
    $mensagem_sucesso = "Error:" . $sql . "<br>" . mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #808080;
            overflow-y: hidden;
        }
        .login {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    <title>Cadastro Bem-sucedido!</title>
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="">
                                <!-- Seu formulário existente aqui -->
                                <?php echo $mensagem_sucesso; ?>
                                <a href="index.php" class="d-block mx-auto mt-3 btn btn-primary mb-2">Login</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>