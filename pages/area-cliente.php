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
        <title><?php echo $_SESSION['nome']; ?> | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
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
                        <div class="margin-order">
                            <h3>PEDIDO 1:</h3>
                            <table>
                                <tbody class="inbox-list">
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>1x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 7,00<p></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>3x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 60,00<p></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="inbox-line">
                                <h4 class="order-price">R$ 67,00</h4>
                                <a href="./detalhes-pedido.php">
                                    <img src="../img/arrow.png" class="details-arrow">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order-box">
                        <div class="margin-order">
                            <h3>PEDIDO 1:</h3>
                            <table>
                                <tbody class="inbox-list">
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>1x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 7,00<p></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>3x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 60,00<p></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="inbox-line">
                                <h4 class="order-price">R$ 67,00</h4>
                                <a href="./detalhes-pedido.php">
                                    <img src="../img/arrow.png" class="details-arrow">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order-box">
                        <div class="margin-order">
                            <h3>PEDIDO 1:</h3>
                            <table>
                                <tbody class="inbox-list">
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>1x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 7,00<p></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>3x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 60,00<p></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="inbox-line">
                                <h4 class="order-price">R$ 67,00</h4>
                                <a href="./detalhes-pedido.php">
                                    <img src="../img/arrow.png" class="details-arrow">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="order-box">
                        <div class="margin-order">
                            <h3>PEDIDO 1:</h3>
                            <table>
                                <tbody class="inbox-list">
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>1x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 7,00<p></td>
                                    </tr>
                                    <tr>
                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                        <td>3x. <b>PRODUTO<b></td>
                                        <td><p class="order-subprice">R$ 60,00<p></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="inbox-line">
                                <h4 class="order-price">R$ 67,00</h4>
                                <a href="./detalhes-pedido.php">
                                    <img src="../img/arrow.png" class="details-arrow">
                                </a>
                            </div>
                        </div>
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