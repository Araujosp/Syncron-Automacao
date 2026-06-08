<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

//Dinheior mensal

$sql = " SELECT
        SUM(itens_pedidos.quantidade_item * itens_pedidos.preco_unitario) AS pedido_total
    FROM pedidos 
    INNER JOIN itens_pedidos
        ON pedidos.id_pedido = itens_pedidos.id_pedido
    WHERE pedidos.status_pagamento = 'Realizado'
    AND YEAR(pedidos.data_pedido) = (
        SELECT YEAR(MAX(pedidos.data_pedido))
        FROM pedidos
    )
    AND MONTH(pedidos.data_pedido) = (
        SELECT MONTH(MAX(pedidos.data_pedido))
        FROM pedidos
    );
";

$stmt = $pdo->prepare($sql);
$stmt->execute();

$receita = $stmt->fetch(PDO::FETCH_ASSOC);

$pedido_total = $receita['pedido_total'];


//Taxa de cancelamento

$sql2 = " SELECT
        COUNT(id_pedido) as todo_pedidos,
        SUM(status_geral = 'Cancelado') AS todo_cancelados
    FROM pedidos 
    WHERE YEAR(pedidos.data_pedido) = (
        SELECT YEAR(MAX(pedidos.data_pedido))
        FROM pedidos
    )
    AND MONTH(pedidos.data_pedido) = (
        SELECT MONTH(MAX(pedidos.data_pedido))
        FROM pedidos
    );
";



$stmt2 = $pdo->prepare($sql2);
$stmt2->execute();

$receita2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$porcentagem_cancel = ($receita2['todo_cancelados'] / $receita2['todo_pedidos']) * 100;


//Pedidos fechados

$sql3 = " SELECT COUNT(id_pedido) as pedidos_count
    FROM pedidos 
    WHERE (status_pagamento = 'Realizado')
    AND YEAR(pedidos.data_pedido) = (
        SELECT YEAR(MAX(pedidos.data_pedido))
        FROM pedidos
    )
    AND MONTH(pedidos.data_pedido) = (
        SELECT MONTH(MAX(pedidos.data_pedido))
        FROM pedidos
    );
";



$stmt3 = $pdo->prepare($sql3);
$stmt3->execute();

$receita3 = $stmt3->fetch(PDO::FETCH_ASSOC);

$pedidos_count = $receita3['pedidos_count'];

//Panorama de vendas

// 1. Mudamos de SUM (somar dinheiro) para COUNT (contar quantidade de pedidos)
$sql_linha = " SELECT MONTH(data_pedido) AS mes, 
        COUNT(id_pedido) AS total 
    FROM pedidos
    WHERE status_pagamento = 'Realizado' 
      AND YEAR(data_pedido) = YEAR(CURRENT_DATE()) 
    GROUP BY MONTH(data_pedido)
    ORDER BY MONTH(data_pedido) ASC
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

$sql4 = "SELECT
    p.categoria,
    SUM(ip.quantidade_item) AS total
FROM itens_pedidos ip
INNER JOIN produtos p
    ON ip.id_produto = p.id_produto
INNER JOIN pedidos ped
    ON ip.id_pedido = ped.id_pedido
WHERE ped.status_pagamento = 'Realizado'
AND DATE_FORMAT(ped.data_pedido, '%Y-%m') = (
    SELECT DATE_FORMAT(MAX(data_pedido), '%Y-%m')
    FROM pedidos
)
GROUP BY p.categoria
ORDER BY total DESC;
";

$stmt4 = $pdo->prepare($sql4);
$stmt4->execute();

$labels = [];
$dados = [];

while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $row['categoria'];
    $dados[] = $row['total'];
}

$sql_barras = "SELECT
    MONTH(data_pedido) AS mes,
    SUM(ip.quantidade_item * ip.preco_unitario) AS faturamento
FROM pedidos p
INNER JOIN itens_pedidos ip
    ON p.id_pedido = ip.id_pedido
WHERE p.status_pagamento = 'Realizado'
GROUP BY MONTH(data_pedido)
ORDER BY MONTH(data_pedido);";

$stmt_barras = $pdo->query($sql_barras);
$dados_barras = $stmt_barras->fetchAll(PDO::FETCH_ASSOC);

$valores_barras = [0, 0, 0, 0, 0, 0]; 

foreach ($dados_barras as $linha_barra) {
    $numero_mes = (int)$linha_barra['mes']; 
    
    if ($numero_mes <= 6) {
        // Agora o $linha['total'] guarda o número de pedidos (ex: 5, 12, 18...)
        $valores_barras[$numero_mes - 1] = (int)$linha_barra['faturamento']; 
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
    <link rel="shortcut icon" href="../img/logo-favicon.png" type="png">

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

            <p><?php echo number_format($porcentagem_cancel, 2) ?>%</p>

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

            <h2>Total de vendas nos últimos meses (R$)</h2>

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

        labels: ['jan', 'fev', 'mar', 'abr', 'mai', 'jun'],

        datasets: [{

            data: <?= json_encode($valores_barras) ?>,

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

const labels = <?= json_encode($labels) ?>;
const dados = <?= json_encode($dados) ?>;

const ctxPizza = document.getElementById('graficoPizza');

new Chart(ctxPizza, {

    type: 'doughnut',

    data: {

        labels: labels,

        datasets: [{

            data: dados,

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