<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require_once "../includes/meta-links.php"; ?>
        <link rel="stylesheet" href="../assets/detalhes-pedido.css">
        <title>[nome do usuário] | Syncron</title>
        <link rel="shortcut icon" href="../img/logo-favicon.png" type="image/png">
    </head>
    <body>
        <?php include '../includes/header.php'; ?>
        <main class="main-content">
            <div class="top-bar">
                <h1>Pedido Nº1:</h1>
            </div>

            <section class="line">
                <div class="order-box">
                    <table class="order-table">
                        <thead>
                            <th></th>
                            <th><h3 class="head">Nome do Produto</h3></th>
                            <th><h3 class="head">Preço Individual</h3></th>
                            <th><h3 class="head">Quantidade</h3></th>
                            <th><h3 class="head">Preço Total</h3></th>
                        </thead>
                        <tbody>
                            <tr class="body">
                                <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                <td><h4 class="product-table">PRODUTO</h4></td>
                                <td><p class="product-table">R$ 20,00</p></td>
                                <td><p class="product-table">3</p></td>
                                <td><p class="product-table">R$ 60,00</p></td>
                            </tr>
                            <tr class="body">
                                <td><img src="../uploads/usuarios/joinha-placeholder.png" class="order-img"></td>
                                <td><h4 class="product-table">PRODUTO</h4></td>
                                <td><p class="product-table">R$ 7,00</p></td>
                                <td><p class="product-table">1</p></td>
                                <td><p class="product-table">R$ 7,00</p></td>
                            </tr>
                        </tbody> 
                    </table>
                </div>

                <div class="situation-box">
                    <h2 class="full-price">R$ 67,00</h2>
                    <br>
                    <p class="situation"><b class="situation-title">Situação:</b> Pedido enviado para entrega.</p>
                </div>
        </section>

        </main>
        <?php include '../includes/footer.php'; ?>
    </body>
</html