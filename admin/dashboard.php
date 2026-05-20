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
        <link rel="stylesheet" href="../assets/dashboard.css">
        <title>Dashboard | Syncron</title>
    </head>
    <body>
        <?php require_once "../includes/sidebar.php"; ?>

        <div class="main-content">
            <div class="top-bar">
                <h1>Dashboard</h1>
            </div>
            
            <div class="balance_line">
                <div class="balance_box">
                    <h1>Receita Mensal</h1>
                    <h2>TESTE</h2>
                </div>
                <div class="balance_box">
                    <h1>Taxa de Cancelamento</h1>
                    <h2>TESTE</h2>
                </div>
                <div class="balance_box">
                    <h1>Pedidos Fechados</h1>
                    <h2>TESTE</h2>
                </div>
            </div>

            <div class="panorama_box">
                <h1>Panorama de Vendas</h1>
            </div>

            <div class="graphic_line">
                <div class="graphic_box">
                    <h1>Total de Vendas - Últimos Anos</h1>
                </div>
                <div class="participation_box">
                    <h1>Participação nas Compras</h1>
                </div>
            </div>
        </div>
        
    </body>
</html>