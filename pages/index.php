<?php
    require_once "../includes/session.php";
    require_once "../includes/crud.php";

    $sql = "SELECT itens_pedidos.id_produto, produtos.nome, SUM(itens_pedidos.quantidade_item), produtos.preco_unitario, produtos.foto FROM itens_pedidos JOIN produtos ON itens_pedidos.id_produto = produtos.id_produto GROUP BY produtos.nome ORDER BY SUM(quantidade_item) DESC LIMIT 4;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $produtos_em_destaque = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/index.css">
    <title>Home | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main class="main">
        <img src="../img/banner.png" class="banner">
        <h1 class="produto">Produtos em destaque</h1>
        <div class="centraliza">
            <?php
                foreach($produtos_em_destaque as $destaque){
            ?>
            <div class="cor" onclick="window.location.href='informacoes-produto.php?id-produto=<?php echo $destaque['id_produto']; ?>'">
                <div>
                    <img src="../<?php echo $destaque['foto']; ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <div class="placeholder-img">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Sem imagem</span>
                    </div>
                </div>
                <div class="info">
                    <p><?php echo $destaque["nome"]; ?></p>
                    <h2 class="preco">R$ <?php echo number_format($destaque['preco_unitario'], 2, ',', '.'); ?></h2>
                </div>
                <a href="carrinho.php?id_produto=<?php echo $destaque["id_produto"]; ?>" class="botao">Adicionar ao carrinho</a>
            </div>
            <?php
                }
            ?>
        </div>
        <div class="login-card-wrapper">
            <section class="Quem_somos">
                <h1>Quem somos</h1>
                <p>A Syncron Automação é uma empresa especializada em soluções para automação industrial, 
                oferecendo produtos e equipamentos voltados para controle, eficiência e produtividade industrial.
                Atuamos no fornecimento de componentes e tecnologias para diferentes segmentos da indústria, garantindo 
                qualidade, confiabilidade e suporte técnico especializado.</p>
                <p>Trabalhamos com uma ampla linha de produtos voltados para automação e controle industrial, atendendo 
                desde pequenas aplicações até projetos industriais de maior porte. Nosso compromisso é oferecer soluções 
                tecnológicas eficientes, seguras e confiáveis, auxiliando empresas na modernização de processos industriais 
                e no aumento da produtividade. Contamos com equipamentos de alta qualidade e suporte especializado para 
                atender às necessidades de diferentes segmentos da indústria, sempre buscando inovação, desempenho e excelência 
                no atendimento aos nossos clientes.</p>
                <p>Além da comercialização de equipamentos industriais, buscamos oferecer um atendimento personalizado, entendendo as 
                necessidades de cada cliente para indicar as melhores soluções em automação. Nossa atuação é focada em eficiência operacional, 
                organização de processos e evolução tecnológica, contribuindo para que empresas tenham maior controle, segurança e desempenho em 
                suas operações industriais.</p>
                <p>Com experiência no segmento e compromisso com a qualidade, a Syncron Automação se destaca pela seriedade, confiança e dedicação em 
                entregar soluções que atendam às exigências do mercado industrial moderno.</p>
            </section>
        </div>
            <section class="carrosel">
                <h1>Empresas Parceiras</h1>
                <div class="carousel">
                    <div class="group">
                        <div class="card"><img src="../img/microsoft.png" class="logo"></div>
                        <div class="card"><img src="../img/openai.png" class="logo"></div>
                        <div class="card"><img src="../img/amazon.png" class="logo"></div>
                        <div class="card"><img src="../img/android.png" class="logo"></div>
                        <div class="card"><img src="../img/claude.png" class="logo"></div>
                        <div class="card"><img src="../img/linkedin.png" class="logo"></div>
                    </div>
                    <div aria-hidden="true" class="group">
                        <div class="card"><img src="../img/microsoft.png" class="logo"></div>
                        <div class="card"><img src="../img/openai.png" class="logo"></div>
                        <div class="card"><img src="../img/amazon.png" class="logo"></div>
                        <div class="card"><img src="../img/android.png" class="logo"></div>
                        <div class="card"><img src="../img/claude.png" class="logo"></div>
                        <div class="card"><img src="../img/linkedin.png" class="logo"></div>
                    </div>
                </div>
            </section>
    </main>
    <?php include '../includes/footer.php'; ?>
    
</body>
</html>