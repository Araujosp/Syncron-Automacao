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
    } else {
        $produto = null;
    }

        /* se não usasse o java script, a lógica do cupom:
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $cupom_digitado = strtolower(trim($_POST['cupom']));  
                if ($cupom_digitado == "desconto10"){
                    if ($produto['preco_unitario'] >= 500 ){
                            $valorFinal = $produto['preco_unitario'] * 0.9;
                     }
                    else {
                        $valorFinal=  $produto['preco_unitario'];
                    }
                }
        }*/
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
                <h2>Meu carrinho:</h2>
                <div class="caixa_pedidos">
                    <?php if ($produto !== null){ ?>
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
                                <p id="contador"><?php echo $quantidade_post ?? "1" ?></p>
                                <button id="mais"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="caixa_reais">
                            <h1>R$ <span id="total"><?php echo $produto['preco_unitario'] ?? '' ?></span></h1>
                            <button><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <?php
                        } else {
                            echo "<h2>Nenhum produto no carrinho</h2>";
                        }
                    ?>
                </div>
            </section>
            <section class="pagamento">
                <a href="pagamento.php" class="botao">Continuar</a>
                    <div class="caixa_cupom">
                        <p>Valor original: <strong><?php if ($produto !== null): ?> R$<?php echo $produto['preco_unitario'] ?? '' ?> <?php endif; ?></strong></p>
                        <p>Adicionar cupom:</p>
                        <form method = "POST">
                            <input type="text" id = "cupom" class ="cupom" placeholder = "DESCONTO10" name = "cupom"><br>
                            <button type="button" id = "aplicar-cupom">
                                Aplicar Cupom
                            </button>
                        </form>
                        <p>Desconto: <strong id="percentual-desconto">0%</strong></p>
                    </div>
                    <div>
                        <h1 class="total">
                            R$ <span id="valor-final"><?php if($produto !== null){ echo $produto['preco_unitario']; } ?></span>
                        </h1>
                    </div>
            </section>
        </div>
    </main>
    <script defer>
const btnMais = document.querySelector('#mais');
const btnMenos = document.querySelector('#menos');
const contador = document.querySelector('#contador');
const total = document.querySelector('#valor-final');

const campoCupom = document.querySelector('#cupom');
const btnAplicarCupom = document.querySelector('#aplicar-cupom');
const percentualDesconto = document.querySelector('#percentual-desconto');

let valor = <?php echo $quantidade_post ?? 1 ?>;
let max = <?php echo $produto['quantidade_estoque'] ?? 0 ?>;
let preco = <?php echo $produto['preco_unitario'] ?? 0 ?>;

let desconto = 0;

const cupons = {
    desconto10: 10,
    desconto20: 20,
    desconto30: 30,
    blackfriday: 50
};

function atualizarTotal() {

    let valorOriginal = valor * preco;
    let valorFinal = valorOriginal;

    if (desconto > 0 && valorOriginal >= 500) {
        valorFinal = valorOriginal * (1 - desconto / 100);
    }

    total.textContent = valorFinal.toFixed(2);
}

btnAplicarCupom.addEventListener('click', () => {

    const cupom = campoCupom.value.trim().toLowerCase();

    if (cupons[cupom]) {
        desconto = cupons[cupom];
        percentualDesconto.textContent = desconto + '%';
        alert('Cupom aplicado!');

    } else {

        desconto = 0;
        percentualDesconto.textContent = '0%';
        alert('Cupom inválido!');
    }

    atualizarTotal();
});

btnMais.addEventListener('click', () => {

    if (valor < max) {
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
    }

});

atualizarTotal();
</script>
</body>
</html>