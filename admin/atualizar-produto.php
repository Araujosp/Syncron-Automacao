<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

$mensagem = "";

$idProduto = $_GET['id'] ?? null;

if (!$idProduto) {
    die("Produto não encontrado.");
}

/*
|--------------------------------------------------------------------------
| BUSCAR PRODUTO NO BANCO
|--------------------------------------------------------------------------
|
| SELECT do produto usando o ID recebido via GET
|
*/
$produto = read($pdo, 'produtos',"id_produto = $idProduto" );


// resultado do SELECT

/*
|--------------------------------------------------------------------------
| ATUALIZAR PRODUTO
|--------------------------------------------------------------------------
|
| Aqui entra o UPDATE quando o formulário for enviado
|
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dadosAtualizados = [
        'nome' => $_POST['nome'],
        'categoria' => $_POST['categoria'],
        'descricao' => $_POST['descricao'],
        'quantidade_estoque' => $_POST['quantidade_estoque'],
        'preco_unitario' => $_POST['preco_unitario']
    ];

    /*
    |--------------------------------------------------------------------------
    | UPDATE NO BANCO
    |--------------------------------------------------------------------------
    |
    | update(...)
    |
    */

    update($pdo, 'produtos', $dadosAtualizados, "id_produto = $idProduto");
    /* UPDATE produtos SET nome = ..., preco = ... WHERE id_produto = ... */

    /*
    |--------------------------------------------------------------------------
    | UPLOAD DE NOVA IMAGEM (OPCIONAL)
    |--------------------------------------------------------------------------
    |
    | Verifica se o usuário enviou nova imagem
    |
    */

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $tipos_permitidos = [
            'image/jpeg',
            'image/png',
            'image/webp',
            'image/avif'
        ];

        if (!in_array($_FILES['foto']['type'], $tipos_permitidos)) {
            die("Tipo de arquivo não permitido.");
        }

        $tamanho_maximo = 5 * 1024 * 1024;

        if ($_FILES['foto']['size'] > $tamanho_maximo) {
            die("Arquivo muito grande.");
        }

        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

        $novoNome = "Produto_" . uniqid() . "." . $extensao;

        $dir = "../uploads/produtos/";

        $caminho = $dir . "$idProduto/";

        $file = $caminho . $novoNome;

        if (!is_dir($caminho)) {
            mkdir($caminho, 0775, true);
        }

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $file)) {
            $fotoUrl = "uploads/produtos/$idProduto/$novoNome";
            update(
                $pdo,
                'produtos',
                ['foto' => $fotoUrl],
                "id_produto = $idProduto"
            );
        } else {
            $mensagem = "Erro ao enviar imagem.";
        }
    }

    $mensagem = "Produto atualizado!";

    header("Refresh: 2; url=estoque.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>

    <link rel="stylesheet" href="../assets/cadastrar.css">
    <link rel="stylesheet" href="../assets/estoque.css">
    <link rel="shortcut icon" href="../img/logo-favicon.png" type="png">
</head>

<body>

<?php require_once "../includes/sidebar.php"; ?>

<div class="container">

    <form method="POST" enctype="multipart/form-data" class="form">

        <h2 class="h2">Atualizar Produto</h2>

        <label>Nome do Produto</label>
        <input
            type="text"
            name="nome"
            value="<?= $produto['nome'] ?? '' ?>"
            required
        >

        <label>Categoria</label>

        <select name="categoria" required>
    <option value="">Selecione</option>
    <option 
        value="CLPs"
        <?= $produto['categoria'] == 'CLPs' ? 'selected' : '' ?>
    >
        CLPs
    </option>
    <option 
        value="Sensores"
        <?= $produto['categoria'] == 'Sensores' ? 'selected' : '' ?>
    >
        Sensores
    </option>
    <option 
        value="IHMs"
        <?= $produto['categoria'] == 'IHMs' ? 'selected' : '' ?>
    >
        IHMs
    </option>
    <option 
        value="Fontes Industriais"
        <?= $produto['categoria'] == 'Fontes Industriais' ? 'selected' : '' ?>
    >
        Fontes Industriais
    </option>
    <option 
        value="Relés"
        <?= $produto['categoria'] == 'Relés' ? 'selected' : '' ?>
    >
        Relés
    </option>
    <option 
        value="Inversores de Frequência"
        <?= $produto['categoria'] == 'Inversores de Frequência' ? 'selected' : '' ?>
    >
        Inversores de Frequência
    </option>
</select>


        <label>Preço Unitário</label>
        <input
            type="number"
            step="0.01"
            name="preco_unitario"
            value="<?= $produto['preco_unitario'] ??''?>"
        >

        <label>Quantidade em Estoque</label>
        <input
            type="number"
            name="quantidade_estoque"
            value="<?= $produto['quantidade_estoque']??''?>"
        >

        <label>Descrição do Produto</label>

        <textarea name="descricao"><?= $produto['descricao']??''?></textarea>

        <label>Selecione a imagem do Produto (Opcional)</label>
        <input type="file" name="foto">

        <button type="submit">Atualizar</button>

        <p><?= $mensagem ?></p>

    </form>

</div>

</body>
</html>