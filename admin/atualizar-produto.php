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

    if (!empty($_FILES['foto']['name'])) {

        // valida imagem

        // move upload

        // atualiza caminho da foto no banco
    }

    $mensagem = "Produto atualizado!";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>

    <link rel="stylesheet" href="../assets/cadastrar.css">
    <link rel="stylesheet" href="../assets/estoque.css">
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
        value="Sensores"
        <?= $produto['categoria'] == 'Sensores' ? 'selected' : '' ?>
    >
        Sensores
    </option>
    <option 
        value="Clps"
        <?= $produto['categoria'] == 'Clps' ? 'selected' : '' ?>
    >
        Clps
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

        <button type="submit">Atualizar</button>

        <p><?= $mensagem ?></p>

    </form>

</div>

</body>
</html>