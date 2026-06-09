<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

$categoriasFiltradas = $_GET["categorias"] ?? [];

$pesquisa = $_GET["pesquisa"] ?? null;

$where = [];
$params = [];

if (!empty($pesquisa)) {
    $where[] = "nome LIKE :pesquisa";
    $params[':pesquisa'] = "%$pesquisa%";
}

if (!empty($categoriasFiltradas)) {
    $cats = [];

    foreach ($categoriasFiltradas as $i => $cat) {
        $key = ":cat$i";
        $cats[] = $key;
        $params[$key] = $cat;
    }

    $where[] = "categoria IN (" . implode(",", $cats) . ")";
}

$sqlWhere = $where ? "WHERE " . implode(" AND ", $where) : "";

$produtosPorPagina = 30;

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
if ($paginaAtual < 1) $paginaAtual = 1;

$offset = ($paginaAtual - 1) * $produtosPorPagina;

$sql = "
    SELECT *
    FROM produtos
    $sqlWhere
    LIMIT :limite OFFSET :offset
";

$stmt = $pdo->prepare($sql);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->bindValue(':limite', $produtosPorPagina, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlCount = "
    SELECT COUNT(*)
    FROM produtos
    $sqlWhere
";

$stmt = $pdo->prepare($sqlCount);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

$stmt->execute();

$totalProdutos = $stmt->fetchColumn();
$totalPaginas = ceil($totalProdutos / $produtosPorPagina);



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
        <div class="centraliza">
            <div class="produtos-container">
                <?php
                    if($produtos){
                        foreach($produtos as $produto){
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
                        <h2 class="preco">R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></h2>
                    </div>
                    <a href="carrinho.php?id_produto=<?php echo $produto["id_produto"]; ?>" class="botao">Adicionar ao carrinho</a>
                </div>
                <?php
                        
                    }
                } else {
                    echo "<h1>Nenhum produto encontrado</h1>";
                }
                ?>
            </div>
            <?php if ($totalPaginas > 1): ?>
            <div class="paginacao">
                <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['pagina' => $i])) ?>">
                    <?php echo $i; ?>
                </a>
                <?php endfor; ?>
            </div>
                <?php endif; ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>