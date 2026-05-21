<?php

require_once "../includes/crud.php";

$produtos = readAll($pdo, 'produtos');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/produtos.css">
    <title>Produtos | Syncron</title>
    <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <aside class="filtro-sidebar">
            <form action="">
                <h2>Filtro por</h2>
                <div class="checkboxes-container">
                    <div>
                        <input type="checkbox" name="clps" id="clps">
                        <label for="clps">CLPs</label>
                    </div>
                    <div>
                        <input type="checkbox" name="sensores" id="sensores">
                        <label for="sensores">Sensores</label>
                    </div>
                    <div>
                        <input type="checkbox" name="ihms" id="ihms">
                        <label for="ihms">IHMs</label>
                    </div>
                    <div>
                        <input type="checkbox" name="fontes" id="fontes">
                        <label for="fontes">Fontes industriais</label>
                    </div>
                    <div>
                        <input type="checkbox" name="reles" id="reles">
                        <label for="reles">Relés</label>
                    </div>
                    <div>
                        <input type="checkbox" name="inversores" id="inversores">
                        <label for="inversores">Inversores de frequência</label>
                    </div>
                </div>
                <div class="botoes-container">
                    <button>Limpar</button>
                    <button>Filtrar</button>
                </div>
            </form>
        </aside>
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
                    <h2 class="preco">R$ <?php echo $produto['preco_unitario']; ?></h2>
                </div>
                <a href="#" class="botao">Adicionar ao carrinho</a>
            </div>
            
            <?php
                }
            }
            ?>
        </div>
    </main>
    <?php include '../includes/footer.php'; ?>
</body>
</html>