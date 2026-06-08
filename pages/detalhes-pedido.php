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
        status_geral as situacao
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
        <title>[nome do usuário] | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Pedido Nº1:</h1>
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
                                    if ($produto['foto'] = 'NULL'){
                                        echo '
                                        <tr class="body">
                                            <td><span>Sem imagem</span></td>
                                            <td><h4 class="product-table">'.$produto['nome'].'</h4></td>
                                            <td><p class="product-table">R$ '.$produto['preco_unitario'].'</p></td>
                                            <td><p class="product-table">'.$produto['quantidade'].'</p></td>
                                            <td><p class="product-table">R$ '.$produto['valor_total'].'</p></td>
                                        </tr>
                                        ';
                                    }else{
                                        echo '
                                        <tr class="body">
                                            <td><img src="../'.$produto['foto'].'" class="order-img"></td>
                                            <td><h4 class="product-table">'.$produto['nome'].'</h4></td>
                                            <td><p class="product-table">R$ '.$produto['preco_unitario'].'</p></td>
                                            <td><p class="product-table">'.$produto['quantidade'].'</p></td>
                                            <td><p class="product-table">R$ '.$produto['valor_total'].'</p></td>
                                        </tr>
                                        ';}
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
                        echo'<h2 class="full-price">R$ '.$valor_pedido.'</h2>';
                    }else{
                        echo'
                            <p class="situation"><b class="situation-title">Valor original:</b> R$ '.$valor_pedido.'</p>
                            <p class="situation"><b class="situation-title">Desconto aplicado:</b> '.$desconto.'%</p>
                            <h2 class="full-price">R$ '.($valor_pedido - (($valor_pedido / 100) * $desconto)).'</h2>
                            ';
                    }
                    ?>
                    <br>
                    <p class="situation"><b class="situation-title">Data de Criação:</b> <?php echo $info['data']; ?></p>
                    <p class="situation"><b class="situation-title">Situação:</b> <?php echo $info['situacao']; ?></p>
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