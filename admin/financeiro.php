<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

if(isset($_GET["situacao_geral"])){
    $SituacaoGeralSelect = !empty($_GET["situacao_geral"]) ? $_GET["situacao_geral"] : null;
} else {
    $SituacaoGeralSelect = null;
}

if(isset($_GET["situacao_pagamento"])){
    $SituacaoPagamentoSelect = !empty($_GET["situacao_pagamento"]) ? $_GET["situacao_pagamento"] : null;
} else {
    $SituacaoPagamentoSelect = null;
}

$where = [];

if($SituacaoGeralSelect != null){
    $where[] = "status_geral = '" . $SituacaoGeralSelect . "'";
}

if($SituacaoPagamentoSelect != null){
    $where[] = "status_pagamento = '" . $SituacaoPagamentoSelect . "'";
}

$pesquisa = $_GET["pesquisa"] ?? null;

if($pesquisa != null){
    $where[] = "clientes.nome LIKE '%" . $pesquisa . "%'";
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

if(!empty($where)){
    $sql .= " WHERE " . implode(" AND ", $where);
}

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
                <form class="filters" method="GET">
                    <div class="filter-group">
                        <label for="situacao_geral">Situação Geral</label>
                        <select name="situacao_geral" id="situacao_geral" onchange="this.form.submit()">
                            <option value="none" disabled hidden>Selecione uma opção</option>
                            <option value="">Todos</option>
                            <?php
                                echo "<option value='Pendente'" . ($SituacaoGeralSelect == 'Pendente' ? 'selected' : '') . ">Pendente</option>";
                                echo "<option value='Em trânsito'" . ($SituacaoGeralSelect == 'Em trânsito' ? 'selected' : '') . ">Em trânsito</option>";
                                echo "<option value='Entregue'" . ($SituacaoGeralSelect == 'Entregue' ? 'selected' : '') . ">Entregue</option>";
                                echo "<option value='Cancelado'" . ($SituacaoGeralSelect == 'Cancelado' ? 'selected' : '') . ">Cancelado</option>";
                            ?>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="situacao_pagamento">Situação do Pagamento</label>
                        <select name="situacao_pagamento" id="situacao_pagamento" onchange="this.form.submit()">
                            <option value="none" disabled hidden>Selecione uma opção</option>
                            <option value="">Todos</option>
                            <?php
                                echo "<option value='Pendente'" . ($SituacaoPagamentoSelect == 'Pendente' ? 'selected' : '') . ">Pendente</option>";
                                echo "<option value='Realizado'" . ($SituacaoPagamentoSelect == 'Realizado' ? 'selected' : '') . ">Realizado</option>";
                            ?>
                        </select>
                    </div>
                    <a href="financeiro.php">Limpar Filtros</a>
                </form>
                <div class="search-bar">
                    <label>Pesquisa</label>
                    <form class="search-bar" action="financeiro.php" method="GET">
                        <input type="text" name="pesquisa" placeholder="Pesquisar...">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </form>
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