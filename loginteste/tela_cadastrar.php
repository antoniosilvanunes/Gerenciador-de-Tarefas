<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="card">
                        <div class="card-body">
                        <div class="text-center">
                                <img src="./imagens/logo.png" alt="" class="img-fluid" style="max-width: 150px;">
                             </div>
                            <h3>Cadastrar</h3>
                            <form id="c" action="config_cadastrar.php" method="POST">
                            
                                <div>
                                    <div class="mb-3">
                                        <label>Nome Completo</label>
                                        <input id="campoNome" type="text" name="nome" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label>E-mail</label>
                                        <input  id="campoEmail" type="email" name="email" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label>Usuário</label>
                                        <input  id="campoUsuario" type="text" name="usuario" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <label>Senha</label>
                                        <input  id="campoSenha" type="password" name="senha" class="form-control">
                                    </div>
                                </div>
                                <div>
                                    <a href="index.php">Já Tenho Cadastro</a>
                                </div>
                                <div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary" id="data-submit">Cadastrar</button>
                                    </div>
                                        <!-- verifica se os campos estão vazios -->
                                    <script class="campo_vazio">
                                    document.getElementById("c").addEventListener("submit", function(event) {
                                    var nome = document.getElementById("campoNome").value;
                                    var email = document.getElementById("campoEmail").value;
                                    var usuario =document.getElementById("campoUsuario").value;
                                    var senha = document.getElementById("campoSenha").value;

                                    if (nome === "" || email === "" || usuario ==="" || senha ==="") {
                                        alert("Por favor, preencha todos os campos");
                                        event.preventDefault(); // Impede o envio do formulário
                                    }
                                });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>