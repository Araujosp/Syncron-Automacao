<?php 

require_once "../includes/crud.php";
require_once "../includes/session.php";

$mensagem_erro = "";

if(isset($_POST['usuario']) && isset($_POST['senha'])){
    $nome_digitado = $_POST['nome'];
    $email_digitado = trim($_POST['email']);
    $telefone_digitado = $_POST['telefone'];

    $tipo_documento_digitado = $_POST['tipo_documento'];
    $documento_digitado = $_POST['documento'];

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

        $novo_cliente = [
            'nome' => $nome_digitado,
            'telefone' => $telefone_digitado,
            'email' => $email_digitado,
            'tipo_cliente' => $tipo_documento_digitado,
            'data_cadastro' => date("Y-m-d"),
            'documento' => $documento_digitado,
            'usuario' => $usuario_digitado,
            'senha' => password_hash($senha_digitada, PASSWORD_DEFAULT)
        ];

        $cliente_criado = create( $pdo,'clientes', $novo_cliente);

        header("Location: login.php?usuario_cadastrado=true");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/cadastro.css">
    <title>Cadastro | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <div class="container">
        <div class="left-side">
            <div class="login-card-wrapper">
                <div class="login-card">

                    <h2>Cadastro</h2>

                    <?php if($mensagem_erro != ""): ?>
                        <div class="erro">
                            <?= $mensagem_erro ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="" method="POST">

                        <div class="input-group">
                            <label for="nome">Nome</label>
                            <input 
                                type="text" 
                                id="nome" 
                                name="nome" 
                                placeholder="Digite seu nome"
                                required
                            >
                        </div>

                        <div class="input-group-half">
                            <div>
                                <label for="email">E-mail</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    placeholder="Digite seu e-mail"
                                    required
                                >
                            </div>
                            <div>
                                <label for="telefone">Telefone</label>
                                <input 
                                    type="tel" 
                                    id="telefone" 
                                    name="telefone" 
                                    placeholder="Digite seu telefone"
                                    required
                                >
                            </div>
                        </div>

                        <div class="input-group-half">
                            <div>
                                <label for="tipo_documento">Tipo de Documento</label>
                                <select name="tipo_documento" id="tipo_documento">
                                    <option value="PF">Pessoa Física</option>
                                    <option value="PJ">Pessoa Jurídica</option>
                                </select>
                            </div>
                            <div>
                                <label for="documento">CPF / CNPJ</label>
                                <input 
                                    type="text" 
                                    id="documento" 
                                    name="documento" 
                                    placeholder="Digite seu documento"
                                    required
                                >
                            </div>
                        </div>

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
                                Cadastrar
                            </button>
                            <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
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