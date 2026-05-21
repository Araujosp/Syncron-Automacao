
<?php

require_once "../includes/crud.php";
require_once "../includes/session.php";

$mensagem = "";

if(isset($_POST['nome'])){

    $novoProduto = [
        'nome' => $_POST['nome'],
        'categoria' => $_POST['categoria'],
        'descricao' => $_POST['descricao'],
        'quantidade_estoque'=> $_POST['quantidade_estoque'],
        'preco_unitario'=> $_POST['preco_unitario'],
        'foto' => ''
    ];

    $idNovoProduto = create($pdo, 'produtos', $novoProduto);

    $tipos_permitidos = [
        'image/jpeg',
        'image/png',
        'image/webp',
        'image/avif'
    ];

    if (!in_array($_FILES['foto']['type'], $tipos_permitidos)) {
        die("Tipo de arquivo não permitido.");
    }

    $tamanho_maximo = 1 * 1024 * 1024;

    if ($_FILES['foto']['size'] > $tamanho_maximo) {
        die("Arquivo muito grande.");
    }

    $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

    $novoNome = "Produto_" . uniqid() . "." . $extensao;

    $dir = "../uploads/produtos/";

    $caminho = $dir . "$idNovoProduto/";

    $file = $caminho . $novoNome;

    if (!is_dir($caminho)) {
        mkdir($caminho, 0775, true);
    }

    if (move_uploaded_file($_FILES['foto']['tmp_name'], $file)) {

        $fotoUrl = "uploads/$idNovoProduto/$novoNome";

        update(
            $pdo,
            'produtos',
            ['foto' => $fotoUrl],
            "id_produto = $idNovoProduto"
        );

        $mensagem = "Produto cadastrado!";

    } else {

        $mensagem = "Erro ao enviar imagem.";

    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro Produto</title>
<link rel="stylesheet" href="../assets/cadastrar.css">
<link rel="stylesheet" href="../assets/estoque.css">
</head>
<body>

<?php  require_once "../includes/sidebar.php"; ?>

<div class="container">

    <form method="POST" enctype="multipart/form-data" class = "form">
        
        <h2 class = "h2">Cadastro de Produto</h2>
        <label>Nome do Produto</label>
        <input type="text" name="nome" placeholder="Nome do produto" required>
        
        <label>Categoria</label>
        <select name="categoria" required>
            <option value="">Selecione</option>
            <option>Sensores</option>
            <option>Clps</option>
            <option>IHMs</option>
            <option>Fontes Industriais</option>
            <option>Relés</option>
            <option>Inversores de Frequência</option>
        </select>
        
        <label>Preço Unitario</label>
        <input type="number" step="0.01" name="preco_unitario" placeholder="Preço">
        
        <label>Quantidade em Estoque</label>
        <input type="number" name="quantidade_estoque" placeholder="Quantidade">
        
        <label>Descrição do Produto</label>
        <textarea name="descricao" placeholder="Descrição do produto"></textarea>
        
        <label>Selecione a imagem do Produto</label>
        <input type="file" name="foto" required>
        
        
        <button type="submit">Cadastrar</button>
        
        <p><?= $mensagem ?></p>
        
    </form>
</div>

</body>
</html>