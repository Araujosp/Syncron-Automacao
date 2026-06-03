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
                        $pedidos = readAll($pdo, 'pedidos', "id_cliente = $id_cliente"); 
                        $count = 1;
                        $id_pedido = readOne($pdo, 'pedidos', 'id_pedido', "id_cliente = $id_cliente");
                        foreach ($pedidos as $pedido){
                            $item = read($pdo, 'itens_pedidos', 'id_pedido = '.$id_pedido.'');
                            $id_produto = readOne($pdo, 'itens_pedidos', 'id_produto', 'id_pedido = '.$id_pedido.'');
                            $produto = read($pdo, 'produtos', 'id_produto = '.$id_produto.'');
                            $sql = " SELECT SUM(quantidade_item * preco_unitario) as value from itens_pedidos where id_pedido = $id_pedido ";
                            echo '
                                <div class="order-line">
                                    <div class="order-box">
                                        <div class="margin-order">
                                            <h3>PEDIDO '.$count.':</h3>
                                            <table>
                                                <tbody class="inbox-list">
                                                        <tr>
                                                            <td><img src="'.$produto['foto'].'" class="order-img"></td>
                                                            <td>'.$item['quantidade_item'].'x. <b>'.$produto['nome'].'<b></td>
                                                            <td><p class="order-subprice">R$ '.$item['preco_unitario'].'<p></td>
                                                        </tr>
                                                </tbody>
                                            </table>
                                        <div class="inbox-line">
                                            <h4 class="order-price">R$ '.$value.'</h4>
                                            <a href="./detalhes-pedido.php?pedido='.$id_pedido.'">
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