<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php require_once "../includes/meta-links.php"; ?>
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
                    <div class="caixa">
                        <img src="../img/clps.jpg" width="100x100">
                        <div class="caixa_titulo">
                            <p>CLPs eletricos</p>
                            <div class="caixa_adicionar">
                                <i class="fa-solid fa-minus"></i>
                                <p>1</p>
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </div>
                        <div class="caixa_reais">
                            <h1>R$ 25,00</h1>
                            <i class="fa-solid fa-trash"></i>
                        </div>
                    </div>
                </div>
            </section>
            <section class="pagamento">
                <a href="#" class="botao">continuar</a>
            </section>
        </div>
    </main>
    
    
</body>
</html>