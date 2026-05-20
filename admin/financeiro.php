<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/estoque.css">
        <title>Financeiro | Syncron</title>
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
                <?php ?>
        </div>

    </body>
</html>