<?php
$pagina_atual = basename($_SERVER["PHP_SELF"]);
?>

<div class="sidebar">
    <div class="user-profile">
        <div class="user-icon">  <img src="../uploads/usuarios/<?= $_SESSION['foto_perfil'] ?>"> </div>
        <div class="user-email"> <?php  echo  ucfirst($_SESSION['usuario']);   ?> </div>
    </div>

    <div class="nav-links">
        <a href="../admin/estoque.php" class="<?= $pagina_atual == "estoque.php" ? 'active' : '' ?>">Estoque</a>
        <a href="../admin/cadastrar-produto.php" class="<?= $pagina_atual == "cadastrar-produto.php" ? 'active' : '' ?>">Cadastro</a>
        <a href="../admin/financeiro.php" class="<?= $pagina_atual == "financeiro.php" ? 'active' : '' ?>">Financeiro</a>
        <a href="../admin/dashboard.php" class="<?= $pagina_atual == "dashboard.php" ? 'active' : '' ?>">Dashboard</a>
    </div>

    <a href="../includes/logout.php" class="logout-btn">Log out</a>

</div>