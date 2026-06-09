


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once "../includes/meta-links.php"; ?>
    <link rel="stylesheet" href="../assets/index.css">
    <link rel="stylesheet" href="../assets/pagamento.css">
    <title>Pagamento | Syncron</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="pagamento">
            <h1>Aguardando pagamento</h1>
            <img src="../img/qr.png" alt="QR code">
            <p>Este código expirará em</p>
            <h1>2 horas</h1>
        </div>
        <aside class="lado">
            <div class="caixa">
                <p>Subtotal: <strong>R$ 75,00</strong></p>
                <p>Desconto: <strong>R$ 10,00</strong></p>
                <hr>
                <p>Valor Total: <strong>R$ 60,00</strong></p>
            </div>
            <a class="button" href="#">Concluir pagamento</a>
        </aside>
    </main>
</body>