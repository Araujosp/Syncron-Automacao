<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$id_cliente = $_SESSION['id_cliente'];
$id_pedido = $_GET['pedido'];

 $sql1 = "
    SELECT
        produtos.`foto` as `foto`,
        produtos.`nome` as `nome`,
        itens_pedidos.`preco_unitario` as `preco_unitario`,
        itens_pedidos.`quantidade_item` as `quantidade`,
        (itens_pedidos.`preco_unitario` * itens_pedidos.`quantidade_item`) as `valor_total`
    FROM `pedidos`
        INNER JOIN `itens_pedidos` on itens_pedidos.`id_pedido` = pedidos.`id_pedido`
        INNER JOIN `produtos` on produtos.`id_produto` = itens_pedidos.`id_produto`
    WHERE
        pedidos.`id_pedido` = $id_pedido
    GROUP BY
        produtos.`nome`;
    ";
    $stmt = $pdo->prepare($sql1);
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "
    SELECT
        data_pedido as data,
        status_geral as situacao,
        status_pagamento as pagamento
        from pedidos
        where id_pedido = $id_pedido
    ";
    $stmt = $pdo->prepare($sql2);
    $stmt->execute();
    $info = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/detalhes-pedido.css">
        <title>Pedido N° <?php echo $id_pedido; ?> | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Pedido Nº <?php echo $id_pedido; ?></h1>
            </div>

            <section class="line">
                <div class="order-box">
                    <table class="order-table">
                        <thead>
                            <th></th>
                            <th><h3 class="head">Nome do Produto</h3></th>
                            <th><h3 class="head">Preço Individual</h3></th>
                            <th><h3 class="head">Quantidade</h3></th>
                            <th><h3 class="head">Preço Total</h3></th>
                        </thead>
                        <tbody>
                            <?php
                                $valor_pedido = 0;
                                foreach ($produtos as $produto){
                                    echo '<tr class="body">';
                                    if ($produto['foto'] = 'NULL'){
                                        echo '<td><span>Sem imagem</span></td>';
                                    }else{
                                        echo '<td><img src="../'.$produto['foto'].'" class="order-img"></td>';
                                    }
                                    echo '<td><h4 class="product-table">'.$produto['nome'].'</h4></td>
                                        <td><p class="product-table">R$ '.number_format($produto['preco_unitario'], 2, ',', '.').'</p></td>
                                        <td><p class="product-table">'.$produto['quantidade'].'</p></td>
                                        <td><p class="product-table">R$ '.number_format($produto['valor_total'], 2, ',', '.').'</p></td>';
                                    $valor_pedido = $valor_pedido + $produto['valor_total'];
                                    }
                            ?>
                            
                        </tbody> 
                    </table>
                </div>

                <div class="situation-box">
                    <?php
                    $desconto = readOne($pdo, 'pedidos', 'desconto_aplicado', "id_pedido = $id_pedido");
                    if ($desconto == 0){
                        echo'<h2 class="full-price">R$ '.number_format($valor_pedido, 2, ',', '.').'</h2>';
                    }else{
                        echo'
                            <p class="situation"><b class="situation-title">Valor original:</b> R$ '.$valor_pedido.'</p>
                            <p class="situation"><b class="situation-title">Desconto aplicado:</b> '.$desconto.'%</p>
                            <h2 class="full-price">R$ '.number_format(($valor_pedido - (($valor_pedido / 100) * $desconto)), 2, ',', '.').'</h2>
                            ';
                    }
                    ?>
                    <br>
                    <?php $data_formatada = (new DateTime($info['data']))->format('d/m/Y'); ?>
                    <p class="situation"><b class="situation-title">Data de Criação:</b> <?php echo $data_formatada; ?></p>
                    <p class="situation"><b class="situation-title">Situação:</b> <?php echo $info['situacao']; ?></p>
                    <p class="situation"><b class="situation-title">Pagamento:</b> <?php echo $info['pagamento']; ?></p>
                </div>
        </section>
        <a href="./area-cliente.php" class="order-return">
            <img src="../img/arrow3.png" class="return-arrow">
            <b>Voltar</b>
        </a>
        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html