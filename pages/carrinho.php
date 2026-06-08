<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <?php 
    require_once "../includes/meta-links.php";
    require_once "../includes/session.php";
    require_once "../includes/crud.php";

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['id_cliente'])) {
        header("Location:../pages/login.php");
        exit;
    }

    // ── Ações POST ───────────────────────────────────────────────────────────
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $acao = $_POST['acao'] ?? '';

        if ($acao === 'adicionar') {
            $id_produto = intval($_POST['id_produto'] ?? 0);
            $quantidade = max(1, intval($_POST['quantidade'] ?? 1));
            if ($id_produto > 0) {
                $produto = read($pdo, "produtos", "id_produto = $id_produto");
                if ($produto) {
                    $estoque = intval($produto['quantidade_estoque']);
                    if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
                    if (isset($_SESSION['carrinho'][$id_produto])) {
                        $nova_qtd = $_SESSION['carrinho'][$id_produto]['quantidade'] + $quantidade;
                        $_SESSION['carrinho'][$id_produto]['quantidade'] = min($nova_qtd, $estoque);
                    } else {
                        $_SESSION['carrinho'][$id_produto] = [
                            'id_produto'     => $id_produto,
                            'nome'           => $produto['nome'],
                            'preco_unitario' => floatval($produto['preco_unitario']),
                            'foto'           => $produto['foto'],
                            'estoque'        => $estoque,
                            'quantidade'     => min($quantidade, $estoque),
                        ];
                    }
                }
            }
            header("Location: carrinho.php");
            exit;
        }

        if ($acao === 'atualizar') {
            $id_produto = intval($_POST['id_produto'] ?? 0);
            $quantidade = intval($_POST['quantidade'] ?? 1);
            if (isset($_SESSION['carrinho'][$id_produto])) {
                $estoque = $_SESSION['carrinho'][$id_produto]['estoque'];
                if ($quantidade < 1) {
                    unset($_SESSION['carrinho'][$id_produto]);
                } else {
                    $_SESSION['carrinho'][$id_produto]['quantidade'] = min($quantidade, $estoque);
                }
            }
            header("Location: carrinho.php");
            exit;
        }

        if ($acao === 'remover') {
            $id_produto = intval($_POST['id_produto'] ?? 0);
            unset($_SESSION['carrinho'][$id_produto]);
            header("Location: carrinho.php");
            exit;
        }

        if ($acao === 'limpar') {
            $_SESSION['carrinho'] = [];
            header("Location: carrinho.php");
            exit;
        }

        if ($acao === 'cupom') {
            $cupons_validos = [
                'desconto10'  => 10,
                'desconto20'  => 20,
                'desconto30'  => 30,
                'blackfriday' => 50,
            ];
            $cupom = strtolower(trim($_POST['cupom'] ?? ''));
            if ($cupom === '') {
                unset($_SESSION['cupom'], $_SESSION['cupom_desconto']);
            } elseif (isset($cupons_validos[$cupom])) {
                $_SESSION['cupom']          = $cupom;
                $_SESSION['cupom_desconto'] = $cupons_validos[$cupom];
                $msg_cupom = 'Cupom aplicado com sucesso!';
                $tipo_msg  = 'sucesso';
            } else {
                unset($_SESSION['cupom'], $_SESSION['cupom_desconto']);
                $msg_cupom = 'Cupom inválido.';
                $tipo_msg  = 'erro';
            }
        }
    }

    // ── Adicionar via GET (link direto do produto) ───────────────────────────
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_produto'])) {
        $id_produto = intval($_GET['id_produto']);
        $quantidade = max(1, intval($_GET['qtd'] ?? 1));
        if ($id_produto > 0) {
            $produto = read($pdo, "produtos", "id_produto = $id_produto");
            if ($produto) {
                $estoque = intval($produto['quantidade_estoque']);
                if (!isset($_SESSION['carrinho'])) $_SESSION['carrinho'] = [];
                if (isset($_SESSION['carrinho'][$id_produto])) {
                    $nova_qtd = $_SESSION['carrinho'][$id_produto]['quantidade'] + $quantidade;
                    $_SESSION['carrinho'][$id_produto]['quantidade'] = min($nova_qtd, $estoque);
                } else {
                    $_SESSION['carrinho'][$id_produto] = [
                        'id_produto'     => $id_produto,
                        'nome'           => $produto['nome'],
                        'preco_unitario' => floatval($produto['preco_unitario']),
                        'foto'           => $produto['foto'],
                        'estoque'        => $estoque,
                        'quantidade'     => min($quantidade, $estoque),
                    ];
                }
            }
        }
    }

    // ── Calcular totais ──────────────────────────────────────────────────────
    $carrinho     = $_SESSION['carrinho'] ?? [];
    $desconto_pct = $_SESSION['cupom_desconto'] ?? 0;
    $cupom_nome   = $_SESSION['cupom'] ?? '';

    $subtotal = 0;
    foreach ($carrinho as $item) {
        $subtotal += $item['preco_unitario'] * $item['quantidade'];
    }

    $desconto_valor = 0;
    if ($desconto_pct > 0 && $subtotal >= 500) {
        $desconto_valor = $subtotal * ($desconto_pct / 100);
    }
    $total_final = $subtotal - $desconto_valor;
    ?>

    <link rel="stylesheet" href="../assets/carrinho.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho | Syncron</title>

    <style>
        /* Placeholder de imagem quebrada */
        .placeholder-img { display: none; }
        img.img-erro      { display: none !important; }
        img.img-erro + .placeholder-img { display: flex; }

        /* Feedback de cupom */
        .msg-cupom {
            font-size: 13px;
            padding: 6px 10px;
            border-radius: 5px;
            margin-bottom: 6px;
        }
        .msg-cupom.sucesso { background: #d1fae5; color: #065f46; }
        .msg-cupom.erro    { background: #fee2e2; color: #991b1b; }

        /* Botão remover item */
        .caixa_reais button { border: none; background: white; cursor: pointer; }
        .caixa_reais i.fa-trash { color: rgb(148, 31, 31); font-size: 20px; }

        /* Botão limpar carrinho */
        .btn-limpar {
            background: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px 12px;
            cursor: pointer;
            font-size: 13px;
            color: #555;
            margin: 8px 20px 0 0;
            float: right;
        }
        .btn-limpar:hover { background: #f1f1f1; color: rgb(148,31,31); border-color: rgb(148,31,31); }

        /* Aviso estoque mínimo para cupom */
        .aviso-min { font-size: 11px; color: #888; margin-top: 4px; }

        /* Badge cupom ativo */
        .cupom-ativo {
            font-size: 13px;
            color: #065f46;
            background: #d1fae5;
            border-radius: 5px;
            padding: 5px 10px;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* Botão remover cupom */
        .btn-rm-cupom {
            background: none;
            border: none;
            color: #991b1b;
            cursor: pointer;
            font-size: 12px;
            text-decoration: underline;
            padding: 0;
            margin-left: auto;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <main>
        <div class="centraliza">

            <!-- ── Seção carrinho ── -->
            <section class="carrinho">
                <h2>Meu carrinho:</h2>

                <div class="caixa_pedidos">
                    <?php if (empty($carrinho)): ?>
                        <h2 style="color:#888; font-weight:400; margin-top:20px;">Nenhum produto no carrinho</h2>
                    <?php else: ?>
                        <?php foreach ($carrinho as $item): ?>
                        <div class="caixa">
                            <!-- Imagem -->
                            <div>
                                <img
                                    src="../<?= htmlspecialchars($item['foto'] ?? '') ?>"
                                    width="100"
                                    onerror="this.classList.add('img-erro')"
                                >
                                <div class="placeholder-img">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                    <span>Sem imagem</span>
                                </div>
                            </div>

                            <!-- Nome + contador -->
                            <div class="caixa_titulo">
                                <p><?= htmlspecialchars($item['nome']) ?></p>
                                <div class="caixa_adicionar">
                                    <!-- Botão – -->
                                    <form method="POST" style="display:contents;">
                                        <input type="hidden" name="acao" value="atualizar">
                                        <input type="hidden" name="id_produto" value="<?= $item['id_produto'] ?>">
                                        <button type="submit" name="quantidade" value="<?= $item['quantidade'] - 1 ?>">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>
                                    </form>

                                    <p><?= $item['quantidade'] ?></p>

                                    <!-- Botão + -->
                                    <form method="POST" style="display:contents;">
                                        <input type="hidden" name="acao" value="atualizar">
                                        <input type="hidden" name="id_produto" value="<?= $item['id_produto'] ?>">
                                        <button
                                            type="submit" name="quantidade"
                                            value="<?= $item['quantidade'] + 1 ?>"
                                            <?= $item['quantidade'] >= $item['estoque'] ? 'disabled title="Estoque máximo"' : '' ?>
                                        ><i class="fa-solid fa-plus"></i></button>
                                    </form>
                                </div>
                            </div>

                            <!-- Preço + lixeira -->
                            <div class="caixa_reais">
                                <h1>R$ <span><?= number_format($item['preco_unitario'] * $item['quantidade'], 2, ',', '.') ?></span></h1>
                                <form method="POST">
                                    <input type="hidden" name="acao" value="remover">
                                    <input type="hidden" name="id_produto" value="<?= $item['id_produto'] ?>">
                                    <button type="submit" title="Remover item">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Limpar tudo -->
                        <form method="POST" style="width:100%; text-align:right;">
                            <input type="hidden" name="acao" value="limpar">
                            <button
                                class="btn-limpar"
                                type="submit"
                                onclick="return confirm('Limpar todos os itens do carrinho?')"
                            ><i class="fa-solid fa-trash-can"></i> Limpar carrinho</button>
                        </form>
                    <?php endif; ?>
                </div>
            </section>

            <!-- ── Seção pagamento ── -->
            <section class="pagamento">
                <?php if (!empty($carrinho)): ?>
                    <a href="pagamento.php" class="botao">Continuar</a>
                <?php else: ?>
                    <span class="botao" style="opacity:.5; cursor:not-allowed;">Continuar</span>
                <?php endif; ?>

                <div class="caixa_cupom">
                    <p>Valor original: <strong>R$ <?= number_format($subtotal, 2, ',', '.') ?></strong></p>

                    <!-- Feedback cupom -->
                    <?php if (isset($msg_cupom)): ?>
                        <div class="msg-cupom <?= $tipo_msg ?>"><?= htmlspecialchars($msg_cupom) ?></div>
                    <?php endif; ?>

                    <!-- Cupom ativo -->
                    <?php if ($desconto_pct > 0): ?>
                        <div class="cupom-ativo">
                            <i class="fa-solid fa-tag"></i>
                            <?= strtoupper($cupom_nome) ?> — <?= $desconto_pct ?>% off
                            <form method="POST" style="display:contents;">
                                <input type="hidden" name="acao" value="cupom">
                                <input type="hidden" name="cupom" value="">
                                <button class="btn-rm-cupom" type="submit">remover</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <form method="POST">
                            <input type="hidden" name="acao" value="cupom">
                            <p>Adicionar cupom:</p>
                            <div>
                                <input
                                    type="text"
                                    id="cupom"
                                    class="cupom"
                                    placeholder="DESCONTO10"
                                    name="cupom"
                                    autocomplete="off"
                                >
                                <button type="submit" id="aplicar-cupom" class="botao">
                                    Aplicar Cupom
                                </button>
                            </div>
                        </form>
                        <?php if ($subtotal > 0 && $subtotal < 500): ?>
                            <p class="aviso-min">* Cupons válidos para compras acima de R$ 500,00</p>
                        <?php endif; ?>
                    <?php endif; ?>

                    <p>Desconto: <strong><?= $desconto_pct > 0 && $subtotal >= 500 ? $desconto_pct . '%' : '0%' ?></strong></p>
                </div>

                <div>
                    <h1 class="total">
                        R$ <?= number_format($total_final, 2, ',', '.') ?>
                    </h1>
                </div>
            </section>

        </div>
    </main>
</body>
</html>