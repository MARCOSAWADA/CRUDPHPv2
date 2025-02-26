<?php
require './Entity/produto.php';

// $dados = new Produto('','','');
$dados = new Produto();
$produtos_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco_unid = $_POST['preco_unid'];

    // $produto = new produto($nome,$descricao,$quantidade);
    $produto = new Produto();
    $produto->nome = $nome;
    $produto->descricao = $descricao;
    $produto->quantidade = $quantidade;
    $produto->preco_unid = $preco_unid;
    $result = $produto->cadastrar();
    if($result){
        echo '<script> alert("produto cadastrado com sucesso!!") </script>';
    }else{
        echo 'Error';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1> Cadastrar produto </h1>
    <form method="POST">
        <input type="text" name="nome" id_produto="nome" placeholder="Digite seu nome">
        <br>
        <input type="text" name="descricao" id_produto="descricao"  placeholder="Digite seu descricao">
        <br>
        <input type="text" name="quantidade" id_produto="quantidade"  placeholder="Digite seu e-mail">
        <br>
        <input type="text" name="preco_unid" id_produto="preco_unid"  placeholder="Digite o preço do produto">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
    </form>

    <br>
    <h3> Produtos Cadastrados </h3>
    <table>
        <tr>
            <td>Id</td>
            <td>Nome</td>
            <td>Descricao</td>
            <td>Quantidade</td>
            <td>Preço</td>
            <td> Editar </td>
            <td> Excluir </td>
        </tr>
        <?php
            foreach($produtos_banco as $produto){
                echo '
                <tr>
                    <td> '.$produto['id_produto'].'  </td>
                    <td> '.$produto['nome'].'  </td>
                    <td> '.$produto['descricao'].'  </td>
                    <td> '.$produto['quantidade'].'  </td>
                    <td> '.$produto['preco_unid'].'  </td>
                    <td> <a href="editar_produto.php?id_produto='.$produto['id_produto'].'"> Editar </a>  </td>
                    <td> <a href="./excluir_produto.php?id_produto='.$produto['id_produto'].'"> Excluir </a>  </td>
                </tr>
                ';
            }
        ?>
    </table>
</body>
</html>