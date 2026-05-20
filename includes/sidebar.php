<div class="sidebar">
    <div class="user-profile">
        <div class="user-icon">  <img src="../uploads/usuarios/<?= $_SESSION['foto_perfil'] ?>"> </div>
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