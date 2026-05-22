<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title>[nome do usuário] | Syncron</title>
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

            <a href="./editar-usuario.php" class="profile-edit">
                <div class="edit-line">
                    <div class="edit-desc">
                        <h2>Editar informações da conta</h2>
                        <p>Nome de usuário, email, senha, informações pessoais...</p>
                    </div>
                    <div>
                        <img src="../img/arrow.png" class="arrow">
                    </div>
                </div>
            </a>

            <article class="order-list">
                <h2>Meus pedidos:</h2>
                <div class="order-line">
                    <div class="order-box">
                    </div>
                    <div class="order-box">
                    </div>
                    <div class="order-box">
                    </div>
                    <div class="order-box">
                    </div>
                    <a href="./ver-pedidos.php" class="more-order">
                        <h3>Ver mais</h3>
                        <img src="../img/arrow.png" class="order-arrow">
                    </a>
                </div>
            </article>

        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>