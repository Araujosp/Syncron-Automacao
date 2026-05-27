<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_cliente']))){
    header("Location:../pages/login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title><?php echo $_SESSION['usuario']; ?> | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header-area-cliente.php'; ?>
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
                        <h2><?php echo $_SESSION['nome']; ?></h2>
                        <p><?php echo $_SESSION['email']; ?></p>
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