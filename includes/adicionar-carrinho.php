<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

if(!isset($_SESSION['id_cliente'])){
    header("Location: login.php");
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$id_produto = $_GET['id_produto'] ?? null;

if(!$id_produto){
    die("Produto inválido");
}

$produto = read(
    $pdo,
    "produtos",
    "id_produto = $id_produto"
);

if(!$produto){
    die("Produto não encontrado");
}

$pedido = read(
    $pdo,
    "pedidos",
    "id_cliente = $id_cliente
    AND status_geral = 'Pendente'"
);

if(!$pedido){

    $id_pedido = create($pdo, "pedidos", [
        "id_cliente" => $id_cliente,
        "data_pedido" => date("Y-m-d"),
        "status_pagamento" => "Pendente",
        "status_geral" => "Pendente"
    ]);

} else {

    $id_pedido = $pedido['id_pedido'];
}

$item = read(
    $pdo,
    "itens_pedidos",
    "id_pedido = $id_pedido
    AND id_produto = $id_produto"
);

if($item){

    update(
        $pdo,
        "itens_pedidos",
        [
            "quantidade_item" =>
                $item['quantidade_item'] + 1
        ],
        "id_item = {$item['id_item']}"
    );

} else {

    create($pdo, "itens_pedidos", [
        "id_pedido" => $id_pedido,
        "id_produto" => $id_produto,
        "quantidade_item" => 1,
        "preco_unitario" => $produto['preco_unitario']
    ]);
}

header("Location: carrinho.php");
exit;