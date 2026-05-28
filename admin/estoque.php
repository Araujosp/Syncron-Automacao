<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

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
            <div class="filters">
                <form class="filter-group" method="GET">
                    <label>Categoria</label>
                    <select name="categoria" id="categoria" onchange="this.form.submit()">
                        <option value="none" disabled hidden>Selecione uma opção</option>
                        <option value="">Tudo</option>
                        <?php
                            echo "<option value='Sensores'" . ($CategoriaSelect == 'Sensores' ? 'selected' : '') . ">Sensores</option>";
                        ?>
                    </select>
                </form>
                <div class="filter-group">
                    <label>Situação</label>
                    <select><option>Todos</option></select>
                </div>
            </div>

            
            
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
                        } else if ($qtd > 0 && $qtd < 50) {
                            $classe_badge = "badge-amarelo";
                            $texto_badge = "Estoque baixo";
                        } else {
                            $classe_badge = "badge-vermelho";
                            $texto_badge = "Sem estoque";
                        }
                        if ($CategoriaSelect == $produto['categoria'] || $CategoriaSelect == null) {
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
                        <a href="excluir-produto.php?id=<?php echo $produto['id_produto']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
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