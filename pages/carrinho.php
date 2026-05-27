<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php require_once "../includes/meta-links.php";
    require_once "../includes/crud.php";
    $id_item = 1;

    $quantidade_post = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quantidade_post = $_POST['quantidade'] ?? null;
        $id_item_post = $_POST['id_item'] ?? null;
        }


    $item = read($pdo, "itens_pedidos", "id_item = $id_item" ); 
    $preco = $item['preco_unitario'];
        ?>

    <link rel="stylesheet" href="../assets/carrinho.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>carrinho</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="centraliza">
            <section class="carrinho">
                <?php if ($quantidade_post !== null): ?>
                Quantidade recebida: <?= $quantidade_post ?>
                <?php endif; ?>
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
                            <h1>R$ <span id="total"><?php echo $item['preco_unitario'] ?></span></h1>
                            <button><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pagamento">
                <a href="pagamento.php" class="botao">continuar</a>
                    <div class="caixa_cupom">
                        <p>Valor original: <strong>R$25,00</strong></p>
                        <p>Adicionar cupom:</p>
                        <p class="cupom">DESCONTO10</p>
                        <p>Desconto: <strong>10%</strong></p>
                    </div>
                    <div>
                        <h1 class="total">R$ <?php echo $quantidade_post?></h1>
                    </div>
            </section>
        </div>
    </main>
    <script defer>
        const btnMais = document.querySelector('#mais');
        const btnMenos = document.querySelector('#menos');
        const contador = document.querySelector('#contador');
        const total = document.querySelector('#total');

        let valor = 1;
        let min = 1;
        let max = <?php echo $item['quantidade_item'] ?>;
        let preco = <?php echo $item['preco_unitario']; ?>;


        function atualizarTotal() {
            total.textContent = (valor * preco).toFixed(2);
            enviarParaBanco();
        }
        //Enviando informações da quantidade selecionada pelo php
        function enviarParaBanco() {
    fetch('../pages/carrinho.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_item=<?php echo $item['id_item']; ?>&quantidade=${valor}`
    })
    .then(res => res.text())
    .then(data => {
        console.log("Resposta do PHP:", data);
    })
    .catch(err => {
        console.error("Erro:", err);
    });
}

        btnMais.addEventListener('click', ()=> {
        if(valor < max){
            valor++;
            contador.textContent = valor;
            atualizarTotal();
        }
        });

         btnMenos.addEventListener('click', () => {
        if (valor > 1) {
            valor--;
            contador.textContent = valor;
            atualizarTotal();
            //pegando o valor do btn = quantidade
            }
        });
    </script>
    -- $total = $item['quantidade_item'] * $item['preco_unitario'];
    
</body>
</html>