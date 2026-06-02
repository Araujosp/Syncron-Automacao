<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

$categoriasFiltradas = $_GET["categorias"] ?? [];

$pesquisa = $_GET["pesquisa"] ?? null;

if($pesquisa != null){
    $produtos = readAll($pdo, "produtos", "nome LIKE '%$pesquisa%'");
} else {
    $produtos = readAll($pdo, 'produtos');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/produtos.css">
    <title>Produtos | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <aside class="filtro-sidebar">
            <form action="produtos.php" method="GET">
                <h2>Filtro por</h2>
                <div class="checkboxes-container">
                    <div>
                        <input type="checkbox" name="categorias[]" id="clps" value="CLPs" <?php echo (in_array("CLPs", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="clps">CLPs</label>
                    </div>
                    <div>
                        <input type="checkbox" name="categorias[]" id="sensores" value="Sensores" <?php echo (in_array("Sensores", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="sensores">Sensores</label>
                    </div>
                    <div>
                        <input type="checkbox" name="categorias[]" id="ihms" value="IHMs" <?php echo (in_array("IHMs", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="ihms">IHMs</label>
                    </div>
                    <div>
                        <input type="checkbox" name="categorias[]" id="fontes" value="Fontes Industriais" <?php echo (in_array("Fontes Industriais", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="fontes">Fontes Industriais</label>
                    </div>
                    <div>
                        <input type="checkbox" name="categorias[]" id="reles" value="Relés" <?php echo (in_array("Relés", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="reles">Relés</label>
                    </div>
                    <div>
                        <input type="checkbox" name="categorias[]" id="inversores" value="Inversores de Frequência" <?php echo (in_array("Inversores de Frequência", $categoriasFiltradas) ? 'checked' : '') ?>>
                        <label for="inversores">Inversores de Frequência</label>
                    </div>
                </div>
                <div class="botoes-container">
                    <a href="produtos.php">Limpar</a>
                    <button type="submit">Filtrar</button>
                </div>
            </form>
        </aside>
        <div class="produtos-container">
            <?php
                if($produtos){
                    foreach($produtos as $produto){
                        if(empty($categoriasFiltradas) || in_array($produto["categoria"], $categoriasFiltradas)){
            ?>
            <div class="cor" onclick="window.location.href='informacoes-produto.php?id-produto=<?php echo $produto['id_produto']; ?>'">
                <div>
                    <img src="../<?php echo $produto['foto']; ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="placeholder-img">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Sem imagem</span>
                    </div>
                </div>
                <div class="info">
                    <p><?php echo $produto['nome']; ?></p>
                    <h2 class="preco">R$ <?php echo $produto['preco_unitario']; ?></h2>
                </div>
                <a href="carrinho.php?id_produto=<?php echo $produto["id_produto"]; ?>" class="botao">Adicionar ao carrinho</a>
            </div>
            <?php
                    }
                }
            } else {
                echo "<h1>Nenhum produto encontrado</h1>";
            }
            ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>