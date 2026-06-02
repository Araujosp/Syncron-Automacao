<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$id_cliente = $_SESSION['id_cliente'];

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title>[nome do usuário] | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Meus Pedidos</h1>
            </div>
            <article class="order-back">
                <?php 
                        $pedidos = read($pdo, 'pedidos', "id_cliente = $id_cliente");
                        $count = 1;
                        foreach ($pedidos as $pedido){
                            echo '
                                <div class="order-line">
                                    <div class="order-box">
                                        <div class="margin-order">
                                            <h3>PEDIDO '.$count.':</h3>
                                            <table>
                                                <tbody class="inbox-list">
                                                    '.$produtos = read($pdo, 'itens_pedido', "id_pedido = $id_pedido");
                                                    foreach ($produto as $produtos)['
                                                    <tr>
                                                        <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                                        <td>1x. <b>PRODUTO<b></td>
                                                        <td><p class="order-subprice">R$ 7,00<p></td>
                                                    </tr>
                                                    ']'
                                                </tbody>
                                            </table>
                                        <div class="inbox-line">
                                            <h4 class="order-price">R$ 67,00</h4>
                                            <a href="./detalhes-pedido.php">
                                                <img src="../img/arrow.png" class="details-arrow">
                                            </a>
                                        </div>
                                    </div>
                                </div>';
                            $count ++ ;
                        }
                    ?>
                <br>
                <a href="./area-cliente.php" class="order-return">
                    <img src="../img/arrow3.png" class="return-arrow">
                    <b>Voltar</b>
                </a>
            </article>

        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>