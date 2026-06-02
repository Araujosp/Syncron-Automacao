<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

//Dinheior mensal

$sql = "
    SELECT
        SUM(itens_pedidos.quantidade_item * itens_pedidos.preco_unitario) AS pedido_total
    FROM pedidos 
    INNER JOIN itens_pedidos
        ON pedidos.id_pedido = itens_pedidos.id_pedido
    WHERE pedidos.status_pagamento = 'Realizado'
    AND MONTH(pedidos.data_pedido) = 1
";



$stmt = $pdo->prepare($sql);
$stmt->execute();

$receita = $stmt->fetch(PDO::FETCH_ASSOC);

$pedido_total = $receita['pedido_total'];


//Taxa de cancelamento

$sql2 = "
    SELECT
        itens_pedidos.quantidade_item,
        SUM(
            CASE WHEN pedidos.status_geral = 'Cancelado' 
            THEN (itens_pedidos.quantidade_item * itens_pedidos.preco_unitario) 
            ELSE 0 
            END
        ) AS total_cancelado
    FROM pedidos 
    INNER JOIN itens_pedidos
        ON pedidos.id_pedido = itens_pedidos.id_pedido
    WHERE MONTH(pedidos.data_pedido) = 1
";



$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$receita2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$total_cancelado = $receita2['total_cancelado'];


//Pedidos fechados

$sql3 = "
    SELECT
        COUNT(DISTINCT pedidos.id_pedido) as pedidos_count
    FROM pedidos 
    INNER JOIN itens_pedidos
        ON pedidos.id_pedido = itens_pedidos.id_pedido
     WHERE pedidos.status_pagamento = 'Realizado' or pedidos.status_pagamento = 'Pendente'
    AND MONTH(pedidos.data_pedido) = 1
";



$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();

$receita3 = $stmt3->fetch(PDO::FETCH_ASSOC);

$pedidos_count = $receita3['pedidos_count'];

//Panorama de vendas

// 1. Mudamos de SUM (somar dinheiro) para COUNT (contar quantidade de pedidos)
$sql_linha = "
    SELECT 
        MONTH(pedidos.data_pedido) AS mes, 
        COUNT(DISTINCT pedidos.id_pedido) AS total -- Conta quantos pedidos únicos foram feitos
    FROM pedidos
    WHERE pedidos.status_geral = 'Entregue' 
      AND YEAR(pedidos.data_pedido) = YEAR(CURRENT_DATE()) 
    GROUP BY MONTH(pedidos.data_pedido)
    ORDER BY MONTH(pedidos.data_pedido) ASC
";

// 2. Executa a query
$stmt4 = $pdo->query($sql_linha);
$dados_do_banco = $stmt4->fetchAll(PDO::FETCH_ASSOC);

// 3. Criamos a estrutura zerada para os 6 meses [Jan, Fev, Mar, Abr, Mai, Jun]
$valores_meses = [0, 0, 0, 0, 0, 0]; 

// 4. Preenche a array com a QUANTIDADE real de pedidos
foreach ($dados_do_banco as $linha) {
    $numero_mes = (int)$linha['mes']; 
    
    if ($numero_mes <= 6) {
        // Agora o $linha['total'] guarda o número de pedidos (ex: 5, 12, 18...)
        $valores_meses[$numero_mes - 1] = (int)$linha['total']; 
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="../assets/dashboard.css">
    <link rel="stylesheet" href="../assets/estoque.css">

    <title>Syncron | Dashboard</title>
</head>
<body>



<?php  require_once "../includes/sidebar.php"  ?>
<!-- MAIN -->

<div class="main">

    <h1>Dashboard</h1>

    <!-- CARDS -->

    <div class="cards">

        <div class="card">

            <h2>Receita Mensal</h2>

            <p>R$ <?php echo $pedido_total?></p>

        </div>

        <div class="card">

            <h2>Taxa Cancelamento</h2>

            <p><?php echo number_format($total_cancelado, 0)?>%</p>

        </div>

        <div class="card">

            <h2>Pedidos Fechados</h2>

            <p><?php echo $pedidos_count?></p>

        </div>

    </div>

    <!-- GRAFICO PRINCIPAL -->

    <div class="grafico-container">

        <h2>Panorama de Vendas</h2>

        <div class="grafico-linha">

            <canvas id="graficoLinha"></canvas>

        </div>

    </div>

    <!-- BOTTOM -->

    <div class="bottom">

        <!-- BARRAS -->

        <div class="box">

            <h2>Total de vendas nos últimos anos</h2>

            <div class="grafico-pequeno">

                <canvas id="graficoBarra"></canvas>

            </div>

        </div>

        <!-- PIZZA -->

        <div class="box">

            <h2>Participação nas Compras Industriais</h2>

            <div class="grafico-pequeno">

                <canvas id="graficoPizza"></canvas>

            </div>

        </div>

    </div>

</div>

<script>

/* GRAFICO LINHA */

const ctxLinha = document.getElementById('graficoLinha');

new Chart(ctxLinha, {

    type: 'line',

    data: {

        labels: ['jan', 'fev', 'mar', 'abr', 'mai', 'jun'],

        datasets: [{

            data: <?= json_encode($valores_meses) ?>,

            borderColor: '#4f7cff',

            backgroundColor: '#4f7cff',

            tension: 0.3,

            fill: false,

            borderWidth: 3,

            pointRadius: 5
        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }
        },

        scales: {

            y: {

                beginAtZero: true,

                grid: {
                    borderDash: [5, 5]
                }
            }
        }
    }
});

/* GRAFICO BARRA */

const ctxBarra = document.getElementById('graficoBarra');

new Chart(ctxBarra, {

    type: 'bar',

    data: {

        labels: ['2019','2020','2021','2022','2023','2024','2025','2026'],

        datasets: [{

            data: [12,18,9,17,18,16,19,12],

            backgroundColor: '#5b87ff'
        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {
                display: false
            }
        }
    }
});

/* GRAFICO PIZZA */

const ctxPizza = document.getElementById('graficoPizza');

new Chart(ctxPizza, {

    type: 'doughnut',

    data: {

        labels: ['Fontes', 'IHMs', 'Sensores', 'CLPs'],

        datasets: [{

            data: [55, 25, 15, 5],

            backgroundColor: [
                '#5b87ff',
                '#b38cff',
                '#f4c06a',
                '#f5dd5d'
            ]
        }]
    },

    options: {

        responsive: true,

        maintainAspectRatio: false
    }
});

</script>

</body>
</html>