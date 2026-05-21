<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/styles.css">
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

            <article class="edit-info">
                <h2>Editar informações do perfil</h2>
                <form class="edit-form" action="area-cliente.php">
                    <fieldset>
                        <div class="edit-box">
                            <input type="text" id="nome" name="nome" required class="edit-input">
                            <label for="nome" class="edit-label">Nome de Usuário</label>
                        </div>
                    </fieldset>
                </form>
            </article>
            </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>