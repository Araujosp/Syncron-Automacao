<header>

    <div class="logo-header">
        <a href="index.php">
            <img src="../img/logo-header.png">
        </a>
    </div>

    <form class="search-bar" action="produtos.php" method="GET">
        <input type="text" name="pesquisa" placeholder="Pesquisar...">
        <i class="fa-solid fa-magnifying-glass"></i>
    </form>

    <nav>
        <a href="index.php"><i class="fa-solid fa-house"></i>Home</a>
        <a href="produtos.php"><i class="fa-solid fa-boxes-stacked"></i>Produtos</a>
        <a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i>Meu Carrinho</a>
        <?php if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_cliente']))){ ?>
        <a href="login.php"><i class="fa-regular fa-circle-user"></i>Login</a>
        <?php } else { ?>
        <a href="area-cliente.php"><i class="fa-solid fa-user"></i>Área do Cliente</a>
        <a href="../includes/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Sair</a>
        <?php } ?>
    </nav>
</header>