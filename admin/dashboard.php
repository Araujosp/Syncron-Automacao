<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
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
</body>
</html>

<?php  require_once "../includes/sidebar.php"  ?>
<!-- MAIN -->

<div class="main">

    <h1>Dashboard</h1>

    <!-- CARDS -->

    <div class="cards">

        <div class="card">

            <h2>Receita Mensal</h2>

            <p>R$ 2.400.000</p>

        </div>

        <div class="card">

            <h2>Taxa Cancelamento</h2>

            <p>4,2%</p>

        </div>

        <div class="card">

            <h2>Pedidos Fechados</h2>

            <p>12.450</p>

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

            data: [300, 900, 1800, 1400, 450, 1600],

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