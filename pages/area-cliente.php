<?php

require_once "../includes/session.php";
require_once "../includes/crud.php";

if(!isset($_SESSION['usuario']) or (!isset($_SESSION['id_cliente']))){
    header("Location:../pages/login.php");
}

$id_cliente = $_SESSION['id_cliente'];

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/area-cliente.css">
        <title><?php echo $_SESSION['nome']; ?> | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Área do Cliente</h1>
            </div>

            <article class="profile-box">
                <div class="profile-line">
                    <?php echo '<img src="../'.$_SESSION['foto_perfil'].'" class="profile-photo">'; ?>
                    <div class="profile-info">
                        <h2><?php echo $_SESSION['nome']; ?></h2>
                        <p><?php echo $_SESSION['email']; ?></p>
                    </div>
                </div>
            </article>

            <a href="./editar-usuario.php" class="profile-edit">
                <div class="edit-line">
                    <div class="edit-desc">
                        <h2>Editar informações da conta</h2>
                        <p>Nome de usuário, email, senha, informações pessoais...</p>
                    </div>
                    <div>
                        <img src="../img/arrow.png" class="arrow">
                    </div>
                </div>
            </a>

            <article class="order-list">
                <h2>Meus pedidos:</h2>
                <div class="order-line">
                    <?php 
                        $pedidos = readAll($pdo, 'pedidos', "id_cliente = $id_cliente");
                        $sql = "
                            SELECT
                                pedidos.id_pedido,
                                SUM(
                                    itens_pedidos.quantidade_item * itens_pedidos.preco_unitario
                                    )
                                AS valor_total,
                                pedidos.data_pedido,
                                pedidos.status_geral
                                FROM pedidos
                                INNER JOIN clientes ON clientes.id_cliente = pedidos.id_cliente
                                INNER JOIN itens_pedidos ON itens_pedidos.id_pedido = pedidos.id_pedido
                                WHERE pedidos.id_cliente = $id_cliente
                                GROUP BY
                                    pedidos.id_pedido,
                                    pedidos.data_pedido
                                limit 4
                        ";
                        
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $count = 1;
                        foreach ($dados as $pedido){
                            echo '
                                
                                    <div class="order-box">
                                        <div class="margin-order">
                                            <h3>PEDIDO '.$count.':</h3>
                                            <p><b>Data de Criação: </b>'.$pedido['data_pedido'].'</p>
                                            <p><b>Situação: </b>'.$pedido['status_geral'].'</p>
                                            <div class="inbox-line">
                                                <h4 class="order-price">R$ '.$pedido['valor_total'].'</h4>
                                                <a href="./detalhes-pedido.php?pedido='.$pedido['id_pedido'].'">
                                                    <img src="../img/arrow.png" class="details-arrow">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            $count ++ ;
                        }
                    ?>

                    <a href="./ver-pedidos.php" class="more-order">
                        <h3>Ver mais</h3>
                        <img src="../img/arrow.png" class="order-arrow">
                    </a>
                </div>
            </article>

        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html>