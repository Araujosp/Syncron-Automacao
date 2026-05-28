<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$pedidos = readAll($pdo, 'pedidos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

$sql = " SELECT pedidos.id_pedido, clientes.nome AS nome_cliente, produtos.nome AS nome_produto,
    itens_pedidos.quantidade_item, itens_pedidos.preco_unitario, pedidos.status_geral, pedidos.status_pagamento,
    pedidos.data_pedido
FROM pedidos

INNER JOIN clientes
ON clientes.id_cliente = pedidos.id_cliente

INNER JOIN itens_pedidos
ON itens_pedidos.id_pedido = pedidos.id_pedido

INNER JOIN produtos
ON produtos.id_produto = itens_pedidos.id_produto
";

$stmt = $pdo->prepare($sql);

$stmt->execute();

$dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/estoque.css">
        <title>Financeiro | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php require_once "../includes/sidebar.php"; ?>

        <div class="main-content">
            <div class="top-bar">
                <div class="filters">
                    <div class="filter-group">
                        <label>Categoria</label>
                        <select><option>Todos</option><option>Sensores</option></select>
                    </div>
                    <div class="filter-group">
                        <label>Situação</label>
                        <select><option>Todos</option></select>
                    </div>
                </div>
                <div class="search-bar">
                    <label>Pesquisa</label>
                    <input type="text" placeholder="Pesquisar...">
                </div>
            </div>

             <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido</th>
                    <th>Cliente</th>
                    <th>Situação Geral</th>
                    <th>Situação do Pagamento</th>
                    <th>Data</th>
                    <th>Preço Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($dados as $row){
                    echo "<tr>";
                    echo "<td>" . $row['id_pedido'] . "</td>";
                    echo "<td>"  . $row['nome_produto'] . "</td>";
                    echo "<td>"  . $row['nome_cliente'] . "</td>";
                    echo "<td>"  . $row['status_geral'] . "</td>";
                    echo "<td>"  . $row['status_pagamento'] . "</td>";
                    echo "<td>"  . $row['data_pedido'] . "</td>";
                    echo "<td>"  . "R$" . $row['quantidade_item'] * $row['preco_unitario']. "</td>";
                    echo "</tr>";
                }
                ?>
                
                    
                
            </tbody>
        </div>

    </body>
</html>