<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php 
    
    require_once "../includes/meta-links.php";

    require_once "../includes/session.php";
    require_once "../includes/crud.php";

    if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_cliente']))){
        header("Location:../pages/login.php");
    }

    $quantidade_post = null;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quantidade_post = $_POST['quantidade'] ?? null;
        $id_item_post = $_POST['id_item'] ?? null;
        }
    
    $id_item = $_GET['id_produto'] ?? null;

    if ($id_item !== null) {
        $produto = read($pdo, "produtos", "id_produto = $id_item");
    } 
    else {
        $produto = null;
    }
    
        ?>

    <link rel="stylesheet" href="../assets/carrinho.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho | Syncron</title>
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
                    <?php if ($produto !== null): ?>
                    <div class="caixa">
                        <div>
                            <img src="../<?php echo $produto['foto']; ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'" width='100x100'>
                            <div class="placeholder-img">
                                <i class="fa-solid fa-boxes-stacked"></i>
                                <span>Sem imagem</span>
                            </div>
                        </div>
                        <div class="caixa_titulo">
                            <p><?php echo $produto['nome'] ?? '' ?></p>
                            <div class="caixa_adicionar">
                               <button id="menos"><i class="fa-solid fa-minus"></i></button>
                                <p id="contador">1</p>
                                <button id="mais"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="caixa_reais">
                            <h1>R$ <span id="total"><?php echo $produto['preco_unitario'] ?? '' ?></span></h1>
                            <button><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
            <section class="pagamento">
                <a href="pagamento.php" class="botao">continuar</a>
                    <div class="caixa_cupom">
                        <p>Valor original: <strong><?php if ($produto !== null): ?> R$<?php echo $produto['preco_unitario'] ?? '' ?> <?php endif; ?></strong></p>
                        <p>Adicionar cupom:</p>
                        <p class="cupom">DESCONTO10</p>
                        <p>Desconto: <strong>10%</strong></p>
                    </div>
                    <div>
                        <h1 class="total">R$ <?php echo $produto['preco_unitario'] ?? '' ?></h1>
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
        let max = <?php echo $produto['quantidade_estoque'] ?? ''?>;
        let preco = <?php echo $produto['preco_unitario'] ?? '' ?>;


        function atualizarTotal() {
            total.textContent = (valor * preco).toFixed(2);
        }


        btnMais.addEventListener('click', ()=> {
        if(valor < max){
            valor++;
            contador.textContent = valor;
            atualizarTotal()
        }
        });

         btnMenos.addEventListener('click', () => {
        if (valor > 1) {
            valor--;
            contador.textContent = valor;
            atualizarTotal()
            }
        });
    </script>
    
</body>
</html>