<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title>[nome do usuário] | Syncron</title>
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
        }
        #submit:hover{
            background-color: #7096c2;;
            transform: translateY(-10%);
            transition: .5s;   
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
                    <div class="profile-photo">
                        <img src="../uploads/usuarios/joinha-placeholder.png">
                    </div>
                    <div class="profile-info">
                        <h2>Usuário</h2>
                        <p>usuario@email.com</p>
                    </div>
                </div>
            </article>

            <article class="edit-info"> 
                <div class="edit-box">
                    <form class="edit-form" action="area-cliente.php">
                        <fieldset>
                            <legend><b>Editar informações do perfil</n></legend>
                            <br>
                            <div class="input-box">
                                <input type="text" id="foto_perfil" name="foto_perfil" required class="edit-input">
                                <label for="foto_perfil" class="edit-label">Foto de Perfil</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="nome" name="nome" required class="edit-input">
                                <label for="nome" class="edit-label">Nome de Usuário</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="email" id="email" name="email" required class="edit-input">
                                <label for="email" class="edit-label">Email</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="password" id="senha" name="senha" required class="edit-input">
                                <label for="senha" class="edit-label">Senha</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="tel" id="telefone" name="telefone" required class="edit-input">
                                <label for="telefone" class="edit-label">Telefone</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="nome" name="nome" required class="edit-input">
                                <label for="nome" class="edit-label">Endereço</label>
                            </div>
                            <br><br>
                            <div class="input-box">
                                <input type="text" id="documento" name="documento" required class="edit-input">
                                <label for="documento" class="edit-label">Documento</label>
                            </div>
                            <br><br>
                            <div class="button-line">
                                <a href="./area-cliente.php" class="return">
                                    <img src="../img/arrow3.png" class="return-arrow">
                                    <b>Voltar</b>
                                </a>
                                <button type="submit" name="submit" id="submit">
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