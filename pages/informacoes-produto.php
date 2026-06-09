<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

$idProduto = $_GET["id-produto"] ?? null;

$produto = read($pdo, 'produtos', 'id_produto = ' . $idProduto);

$qtd = $produto['quantidade_estoque'];

if ($qtd >= 50) {
    $statusIcone = "<i class='fa-solid fa-circle-check status ok'></i>";
    $situacaoProduto = "Disponível";
} else if ($qtd > 0 && $qtd < 50) {
    $statusIcone = "<i class='fa-solid fa-triangle-exclamation status warning'></i>";
    $situacaoProduto = "Estoque baixo";
} else {
    $statusIcone = "<i class='fa-solid fa-circle-xmark status danger'></i>";
    $situacaoProduto = "Sem estoque";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>wwww
    <link rel="stylesheet" href="../assets/informacoes-produto.css">
    <title><?php echo $produto["nome"]; ?> | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <main class="main">
        <div class="imagem-produto">
            <img src="../<?php echo $produto["foto"]; ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
            <div class="placeholder-img">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span>Sem imagem</span>
            </div>
        </div>
        <div class="detalhes-produto">
            <h1><?php echo $produto['nome']; ?></h1>
            <div class="classificacao-container">
                <p>Código: <?php echo $produto['id_produto']; ?></p>
                <p>Categoria: <?php echo $produto['categoria']; ?></p>
            </div>
            <div class="situacao-container">
                <div class="situacao-icone">
                    <i class="fa-solid fa-box-archive"></i>
                    <?php echo $statusIcone; ?>
                </div>
                <p><?php echo $situacaoProduto; ?></p>
            </div>
            <h1 class="preco">R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></h1>
            <div class="descricao">
                <h2>Pequena descrição</h2>
                <p><?php echo $produto['descricao']; ?></p>
            </div>
            <form class="botoes" action="carrinho.php" method="POST">
                <div class="quantidade">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" name="quantidade" id="quantidade" placeholder="Informe a quantidade" min="1" value="1">
                </div>
                <input type="hidden" name="id_produto" value="<?php echo $produto['id_produto']; ?>">
                <input type="hidden" name="acao" value="adicionar">
                <button type="submit" class="botao" >Adicionar ao carrinho</submit>
            </form>
        </div>
    </main>
    
    <?php include '../includes/footer.php'; ?>
    
</body>
</html>