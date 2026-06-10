<?php 

require_once "../includes/crud.php";
require_once "../includes/session.php";

if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_cliente'])) {
    header("Location:../pages/login.php");
    exit;
}

$carrinho = $_SESSION["carrinho"];
$cupom_desconto = $_SESSION["cupom_desconto"] ?? 0;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $novoPedido = [
        "id_cliente" => $_SESSION["id_cliente"],
        "data_pedido" => date("Y-m-d"),
        "status_pagamento" => "Realizado",
        "status_geral" => "Pendente",
        "desconto_aplicado" => $cupom_desconto
    ];

    $idPedidoCriado = create($pdo,'pedidos', $novoPedido);

    foreach($carrinho as $item_pedido){
        $novoItemPedido = [
            "id_pedido" => $idPedidoCriado,
            "id_produto" => $item_pedido["id_produto"],
            "quantidade_item" => $item_pedido["quantidade"],
            "preco_unitario" => $item_pedido["preco_unitario"]
        ];

        $idItemPedidoCriado = create($pdo,'itens_pedidos', $novoItemPedido);
    }

    $_SESSION["carrinho"] = null;
    $_SESSION["cupom"] = null;
    $_SESSION["cupom_desconto"] = null;

    header("Location: detalhes-pedido.php?pedido=$idPedidoCriado");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo-favicon.png" type="png">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/pagamento.css">
    <title>Pagamento | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="pagamento">
            <h1>Aguardando pagamento</h1>
            <img src="../img/qr.png" alt="QR code">
            <p>Este código expirará em</p>
            <h1>2 horas</h1>
        </div>
        <form class="lado" action="pagamento.php" method="POST">
            <div class="caixa">
                <p>Subtotal: <strong>R$ <?php 
                    $subtotal = 0;

                    foreach($carrinho as $item_pedido){
                        $subtotal += $item_pedido["preco_unitario"] * $item_pedido["quantidade"];
                    }

                    echo number_format($subtotal, 2, ',', '.');
                ?></strong></p>
                <p>Desconto: <strong>R$ <?php 
                    $desconto = $subtotal / 100 * $cupom_desconto;
                    echo number_format($desconto, 2, ',', '.');
                ?></strong></p>
                <hr>
                <p>Valor Total: <strong>R$ <?php echo number_format(($subtotal - $desconto), 2, ',', '.'); ?></strong></p>
            </div>
            <button class="button" type="submit">Concluir pagamento</button>
        </form>
    </main>
</body>