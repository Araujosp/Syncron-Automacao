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
                <div class="order-line">
                <?php 
                        $pedidos = readAll($pdo, 'pedidos', "id_cliente = $id_cliente");
                        $sql = "
                            SELECT 
                                SUM(
                                    itens_pedidos.quantidade_item * itens_pedidos.preco_unitario
                                ) AS valor_total
                            FROM pedidos
                            INNER JOIN clientes ON clientes.id_cliente = pedidos.id_cliente
                            INNER JOIN itens_pedidos ON itens_pedidos.id_pedido = pedidos.id_pedido
                            WHERE pedidos.id_cliente = $id_cliente
                            GROUP BY
                                pedidos.id_pedido,
                                pedidos.data_pedido
                        ";
                        
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $count = 1;
                        foreach ($dados as $pedido){
                            echo '
                                
                                    <div class="order-box">
                                        <div class="margin-order">
                                            <h3>PEDIDO '.$count.':</h3>
                                            <div class="inbox-line">
                                                <h4 class="order-price">R$ '.$pedido['valor_total'].'</h4>
                                                <a href="./detalhes-pedido.php">
                                                    <img src="../img/arrow.png" class="details-arrow">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            $count ++ ;
                        }
                    ?>
                </div>
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