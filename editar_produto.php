<?php

require './Entity/Produto.php';

$id_recebido = $_GET['id_produto'];


if(!isset($id_recebido) or !is_numeric($id_recebido)){
    header('location: index.php');
    exit;
}

$produto = Produto::buscar_by_id($id_recebido);
$nome = $produto->nome;
$descricao = $produto->descricao;
$quantidade = $produto->quantidade;
$preco_unid = $produto->preco_unid;

if(isset($_POST['editar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco_unid = $_POST['preco_unid'];

    $cli_editado = new Produto();
    $cli_editado->id_produto = $id_recebido;
    $cli_editado->nome = $nome;
    $cli_editado->descricao = $descricao;
    $cli_editado->quantidade = $quantidade;
    $cli_editado->preco_unid = $preco_unid;

    $result = $cli_editado->atualizar();
    if($result){
        echo '<script> alert("Atualizado com sucesso!!!") </script>' ;
        echo "<meta http-equiv='refresh' content='0.5;url=cadastro_foto_produto.php'>";
    }else{
        echo 'Erro ao atualizar';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EdItAr PrOdUtO</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Produto</h1>

     <form method="POST">
        <input name="nome" id="nome" type="text" value="<?= $nome;?>">
        <input name="descricao" id="descricao" type="text"  value="<?= $descricao;?>">
        <input name="quantidade" id="quantidade" type="quantidade"  value="<?= $quantidade;?>">
        <input name="preco_unid" id="preco_unid" type="preco_unid" value="<?= $preco_unid;?>">
        <input name="editar" type="Submit" value="Editar">
     </form>

</body>
</html>