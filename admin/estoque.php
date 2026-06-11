<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$pesquisa = $_GET["pesquisa"] ?? null;

if($pesquisa != null){
    $produtos = readAll($pdo, "produtos", "nome LIKE '%$pesquisa%'");
} else {
    $produtos = readAll($pdo, 'produtos');
}


if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

if(isset($_GET["categoria"])){
    $CategoriaSelect = !empty($_GET["categoria"]) ? $_GET["categoria"] : null;
} else {
    $CategoriaSelect = null;
}

if(isset($_GET["situacao"])){
    $SituacaoSelect = !empty($_GET["situacao"]) ? $_GET["situacao"] : null;
} else {
    $SituacaoSelect = null;
}


if (isset($_GET['excluir'])) {

    $id = (int) $_GET['excluir'];
    
    // try{
        delete($pdo, 'itens_pedidos',"id_produto = $id");
        delete($pdo, 'produtos',"id_produto = $id");
    // }
    // catch(PDOException $e) {
    //     $mensagem_erro = "Este produto não pode ser excluído porque já está vinculado a pedidos.";
    //     echo $mensagem_erro;
    //     }

    // header("Location: estoque.php");
    // exit;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/estoque.css">
    <title>Estoque | Syncron</title>
    <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
</head>
<body>

    <?php require_once "../includes/sidebar.php"; ?>

    <div class="main-content">
        
        <div class="top-bar">
            <form class="filters" method="GET">
                <div class="filter-group">
                    <label>Categoria</label>
                    <select name="categoria" id="categoria" onchange="this.form.submit()">
                        <option value="none" disabled hidden>Selecione uma opção</option>
                        <option value="">Tudo</option>
                        <?php
                            echo "<option value='CLPs'" . ($CategoriaSelect == 'CLPs' ? 'selected' : '') . ">CLPs</option>";
                            echo "<option value='Sensores'" . ($CategoriaSelect == 'Sensores' ? 'selected' : '') . ">Sensores</option>";
                            echo "<option value='IHMs'" . ($CategoriaSelect == 'IHMs' ? 'selected' : '') . ">IHMs</option>";
                            echo "<option value='Fontes Industriais'" . ($CategoriaSelect == 'Fontes Industriais' ? 'selected' : '') . ">Fontes Industriais</option>";
                            echo "<option value='Relés'" . ($CategoriaSelect == 'Relés' ? 'selected' : '') . ">Relés</option>";
                            echo "<option value='Inversores de Frequência'" . ($CategoriaSelect == 'Inversores de Frequência' ? 'selected' : '') . ">Inversores de Frequência</option>";
                        ?>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="situacao">Situação</label>
                    <select name="situacao" id="situacao" onchange="this.form.submit()">
                        <option value="none" disabled hidden>Selecione uma opção</option>
                        <option value="">Todos</option>
                        <?php
                            echo "<option value='Disponível'" . ($SituacaoSelect == 'Disponível' ? 'selected' : '') . ">Disponível</option>";
                            echo "<option value='Estoque baixo'" . ($SituacaoSelect == 'Estoque baixo' ? 'selected' : '') . ">Estoque baixo</option>";
                            echo "<option value='Sem estoque'" . ($SituacaoSelect == 'Sem estoque' ? 'selected' : '') . ">Sem estoque</option>";
                        ?>
                    </select>
                </div>
                <a href="estoque.php">Limpar Filtros</a>
            </form>
            <div class="search-bar">
                <label>Pesquisa</label>
                <form class="search-bar" action="estoque.php" method="GET">
                    <input type="text" name="pesquisa" placeholder="Pesquisar...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Situação</th>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Verifica se existem produtos cadastrados
                    if($produtos) {
                        foreach($produtos as $produto) { 
                            
                            // Lógica para definir a cor e o texto da Situação baseada na quantidade
                            $qtd = $produto['quantidade_estoque'];
                            if ($qtd >= 50) {
                                $classe_badge = "badge-verde";
                                $texto_badge = "Disponível";
                                $situacao = "Disponível";
                            } else if ($qtd > 0 && $qtd < 50) {
                                $classe_badge = "badge-amarelo";
                                $texto_badge = "Estoque baixo";
                                $situacao = "Estoque baixo";
                            } else {
                                $classe_badge = "badge-vermelho";
                                $texto_badge = "Sem estoque";
                                $situacao = "Sem estoque";
                            }
                        if (($CategoriaSelect == $produto['categoria'] || $CategoriaSelect == null) && ($SituacaoSelect == $situacao || $SituacaoSelect == null)) {
                ?>
                <tr>
                    <td><?php echo $produto['id_produto']; ?></td>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><span class="badge <?php echo $classe_badge; ?>"><?php echo $texto_badge; ?></span></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td><?php echo $produto['quantidade_estoque']; ?></td>
                    <td>R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></td>
                    <td class="acoes">
                        <a href="atualizar-produto.php?id=<?php echo $produto['id_produto']; ?>" class="btn-editar">Editar</a>
                        <a href="estoque.php?excluir=<?php echo $produto['id_produto']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>

                <?php   
                        }
                    } // fim do foreach
                } else {
                    echo "<tr><td colspan='7'>Nenhum produto encontrado no estoque.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

</body>
</html>