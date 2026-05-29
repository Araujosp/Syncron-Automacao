<?php 

require_once "../includes/crud.php";
require_once "../includes/session.php";

$mensagem_erro = "";

$id_cliente = $_SESSION['id_cliente'];

if(isset($_POST['usuario']) && isset($_POST['senha'])){
    $nome_digitado = $_POST['nome'];
    $email_digitado = trim($_POST['email']);
    $telefone_digitado = $_POST['telefone'];
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
        // ATUALIZAR SISTEMA

        $dados_atualizados = [
            'nome' => $nome_digitado,
            'usuario' => $usuario_digitado,
            'email' => $email_digitado,
            'senha' => password_hash($senha_digitada, PASSWORD_DEFAULT),
            'documento' => $documento_digitado,
            'telefone' => $telefone_digitado
        ];

        $cliente_upd = update( $pdo,'clientes', $dados_atualizados, 'id_cliente = '.$id_cliente);

        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $tipos_permitidos = [
                'image/jpeg',
                'image/png',
                'image/webp',
                'image/avif'
            ];

            if (!in_array($_FILES['foto']['type'], $tipos_permitidos)) {
                die("Tipo de arquivo não permitido.");
            }

            $tamanho_maximo = 5 * 1024 * 1024;

            if ($_FILES['foto']['size'] > $tamanho_maximo) {
                die("Arquivo muito grande.");
            }

            $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

            $novoNome = "Usuario_" . uniqid() . "." . $extensao;

            $dir = "../uploads/usuarios/";

            $caminho = $dir . "$id_cliente/";

            $file = $caminho . $novoNome;

            if (!is_dir($caminho)) {
                mkdir($caminho, 0775, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $file)) {
                $fotoUrl = "uploads/usuarios/$id_cliente/$novoNome";
                update(
                    $pdo,
                    'clientes',
                    ['foto_perfil' => $fotoUrl],
                    "id_cliente = $id_cliente"
                );

                header("Location: login.php");
            } else {
                $mensagem = "Erro ao enviar imagem.";
            }
        } else {
            header("Location: login.php");
        }   
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title>Editar <?php echo $_SESSION['nome']; ?> | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
        <style>
        #submit{
            background-color: rgba(53, 100, 155, 1);;
            width: 25%;
            margin-bottom: 10px;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            transition: .5s ease-in-out;   
        }
        #submit:hover{
            background-color: #7096c2;;
            transform: translateY(-10%);
       }
        .submit-arrow{
            width: 20px;
            height: 20px;
            margin-left: 10px;
            margin-bottom: -5px;
        }
    </style>
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Área do Cliente</h1>
            </div>

            <article class="profile-box">
                <div class="profile-line">
                    <?php echo '<img src="../'.$_SESSION['foto_perfil'].'" class="profile-photo">'; ?>
                    <div class="profile-info">
                        <h2><?php echo $_SESSION['nome']; ?></h2>
                        <p><?php echo $_SESSION['email']; ?></p>
                    </div>
                </div>
            </article>

            <article class="edit-info"> 
                <div class="edit-box">
                    <form class="edit-form" action="" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <legend><b>Editar informações do perfil</n></legend>
                            <br>
                            <div class="input-box">
                                <input type="file" id="foto" name="foto" class="edit-input-file">
                                <label for="foto" class="edit-label-file">Foto de Perfil</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="nome" name="nome" class="edit-input">
                                <label for="nome" class="edit-label">Nome de Exibição</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="usuario" name="usuario" class="edit-input">
                                <label for="usuario" class="edit-label">Nome de Usuário</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="email" id="email" name="email" class="edit-input">
                                <label for="email" class="edit-label">Email</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="password" id="senha" name="senha" class="edit-input">
                                <label for="senha" class="edit-label">Senha</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="documento" name="documento" class="edit-input">
                                <label for="documento" class="edit-label">Documento</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="tel" id="telefone" name="telefone" class="edit-input">
                                <label for="telefone" class="edit-label">Telefone</label>
                            </div>
                            <br><br>
                            <div class="button-line">
                                <a href="./area-cliente.php" class="return">
                                    <img src="../img/arrow3.png" class="return-arrow">
                                    <b>Voltar</b>
                                </a>
                                <button type="submit" name="submit" id="submit" onclick="return confirm('Ao atualizar o usuário, você terá que fazer login novamente. Tem certeza que deseja prosseguir?')">
                                    <b>Salvar alterações<b>
                                    <img src="../img/arrow2.png" class="submit-arrow">
                                </button>
                            </div>
                            <br><br>
                        </fieldset>
                    </form>
                </div>
            </article>
            </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>