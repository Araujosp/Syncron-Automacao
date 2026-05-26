<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php require_once "../includes/meta-links.php"?>
    <link rel="stylesheet" href="../assets/carrinho.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>carrinho</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="centraliza">
            <section class="carrinho">
                <h2>Meu carrinho:</h2>
                <div class="caixa_pedidos">
                    <div class="caixa">
                        <img src="../img/clps.jpg" width="100x100">
                        <div class="caixa_titulo">
                            <p>CLPs eletricos</p>
                            <div class="caixa_adicionar">
                               <button id="menos"><i class="fa-solid fa-minus"></i></button>
                                <p id="contador">1</p>
                                <button id="mais"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="caixa_reais">
                            <h1>R$ 25,00</h1>
                            <button><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pagamento">
                <a href="#" class="botao">continuar</a>
                    <div class="caixa_cupom">
                        <p>Valor original: <strong>R$25,00</strong></p>
                        <p>Adicionar cupom:</p>
                        <p class="cupom">DESCONTO10</p>
                        <p>Desconto: <strong>10%</strong></p>
                    </div>
                    <div>
                        <h1 class="total">R$ 13,50</h1s>
                    </div>
            </section>
        </div>
    </main>
    <script defer>
        const btnMais = document.querySelector('#mais');
        const btnMenos = document.querySelector('#menos');
        const contador = document.querySelector('#contador');

        let valor = 1;

        btnMais.addEventListener('click', ()=> {
            valor++;
            contador.textContent = valor;
        });

         btnMenos.addEventListener('click', () => {
        if (valor > 0) {
            valor--;
            contador.textContent = valor;
            }
        });
    </script>
    
</body>
</html>