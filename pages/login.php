<?php 

require_once "../includes/crud.php";
require_once "../includes/session.php";

if(isset($_GET['usuario_cadastrado'])) {
    $mensagem_erro = "Usuário cadastrado com sucesso!";
} else {
    $mensagem_erro = "";
}

if(isset($_POST['usuario']) && isset($_POST['senha'])){

    $usuario_digitado = trim($_POST['usuario']);
    $senha_digitada = trim($_POST['senha']);

    // Verifica campos vazios
    if(strlen($usuario_digitado) == 0){

        $mensagem_erro = "Usuário não pode estar vazio.";

    }
    else if(strlen($senha_digitada) == 0){

        $mensagem_erro = "Senha não pode estar vazia.";

    }
    else{
   
        // LOGIN SISTEMA
      

        $condicao = "usuario = '$usuario_digitado'";

        $usuario_encontrado = read( $pdo,'usuarios_sistema', $condicao);

        if($usuario_encontrado){

            if(password_verify($senha_digitada,$usuario_encontrado['senha'])){

                $_SESSION['id_usuario'] =
                    $usuario_encontrado['id_usuario'];

                $_SESSION['usuario'] =
                    $usuario_encontrado['usuario'];

                $_SESSION['foto_perfil'] =
                    $usuario_encontrado['foto_perfil'];

                $_SESSION['tipo'] = "sistema";

                header("Location: ../admin/estoque.php");
                exit;
            }
            else{

                $mensagem_erro = "Senha incorreta.";
            }
        }
        else{

            // LOGIN CLIENTE

            $cliente_encontrado = read($pdo,'clientes', $condicao);

            if($cliente_encontrado){

                if(password_verify( $senha_digitada, $cliente_encontrado['senha'])){

                    $_SESSION['id_cliente'] =
                        $cliente_encontrado['id_cliente'];

                    $_SESSION['usuario'] =
                        $cliente_encontrado['usuario'];

                    $_SESSION['tipo_cliente'] =
                        $cliente_encontrado['tipo_cliente'];

                    $_SESSION['nome'] =
                        $cliente_encontrado['nome'];

                    $_SESSION['email'] =
                        $cliente_encontrado['email'];

                    header("Location:area-cliente.php");
                    exit;
                }
                else{
                    $mensagem_erro = "Senha incorreta.";
                }
            }
            else{
                $mensagem_erro = "Usuário não encontrado.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/login.css">
    <title>Login | Syncron</title>
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        <div class="left-side">
            <div class="login-card-wrapper">
                <div class="login-card">

                    <h2>Login</h2>

                    <?php if($mensagem_erro != ""): ?>
                        <div class="erro">
                            <?= $mensagem_erro ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="" method="POST">

                        <div class="input-group">
                            <label for="usuario">Usuário</label>
                            <input 
                                type="text" 
                                id="usuario" 
                                name="usuario" 
                                placeholder="Digite seu usuário"
                                required
                            >
                        </div>
                        
                        <div class="input-group">
                            <label for="senha">Senha</label>
                            <input 
                                type="password" 
                                id="senha" 
                                name="senha" 
                                placeholder="Digite sua senha"
                                required
                            >
                        </div>
                        
                        <div class="botoes">
                            <button type="submit" class="btn-submit">
                                Acessar
                            </button>
                            <p>Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="shape"></div>
        </div>
    </div>

</body>
</html>