<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_usuario']))){
    header("Location:../pages/login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/estoque.css">
    <title>Estoque | Syncron</title>
</head>
<body>

    <div class="sidebar">
        <div class="user-profile">
            <div class="user-icon">👤</div>
            <div class="user-email"> <?php  echo  ucfirst($_SESSION['usuario']);   ?> </div>
        </div>

        <div class="nav-links">
            <a href="#" class="active">Estoque</a>
            <a href="#">Cadastro</a>
            <a href="#">Financeiro</a>
            <a href="#">Dashboard</a>
        </div>

        <a href="../includes/logout.php" class="logout-btn">Log out</a>

    </div>

    <div class="main-content">
        
        <div class="top-bar">
            <div class="filters">
                <div class="filter-group">
                    <label>Categoria</label>
                    <select><option>Todos</option><option>Sensores</option></select>
                </div>
                <div class="filter-group">
                    <label>Situação</label>
                    <select><option>Todos</option></select>
                </div>
            </div>
            
            <div class="search-bar">
                <label>Pesquisa</label>
                <input type="text" placeholder="Pesquisar...">
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
                ?>
                <tr>
                    <td><?php echo $produto['id_produto']; ?></td>
                    <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                    <td><span class="badge <?php echo $classe_badge; ?>"><?php echo $texto_badge; ?></span></td>
                    <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                    <td><?php echo $produto['quantidade_estoque']; ?></td>
                    <td>R$ <?php echo number_format($produto['preco_unitario'], 2, ',', '.'); ?></td>
                    <td class="acoes">
                        <a href="editar_produto.php?id=<?php echo $produto['id']; ?>" class="btn-editar">Editar</a>
                        <a href="excluir_produto.php?id=<?php echo $produto['id']; ?>" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
                <?php 
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