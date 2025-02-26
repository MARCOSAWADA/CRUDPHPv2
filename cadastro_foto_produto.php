<!-- http://localhost/projeto/CRUDPHPv2/cadastro_fotoproduto_produto.php -->

<?php
require './Entity/Produto.php';

$dados = new Produto();
$produtos_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco_unid = $_POST['preco_unid'];


    // ____CÓDIGO PARA CADASTRAR fotoprodutoS NO SERVIDOR BANCO DE DADOS___________
    

    $arquivo = $_FILES['fotoproduto'];
    if ($arquivo['error']) die("Falha ao enviar a fotoproduto");
    $pasta = './upload/';
    $nome_fotoproduto = $arquivo['name'];
    $novo_nome = uniqid();

    $extensao = strtolower(pathinfo($nome_fotoproduto, PATHINFO_EXTENSION));
    if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a fotoproduto");
    $caminho = $pasta . $novo_nome . '.' . $extensao;
    $fotoproduto = move_uploaded_file($arquivo['tmp_name'], $caminho);


    // _________________________________________________________________________

    $produto = new Produto();
    $produto->nome = $nome;
    $produto->descricao = $descricao;
    $produto->quantidade = $quantidade;
    $produto->preco_unid = $preco_unid;
        $produto->fotoproduto = $caminho;
    $result = $produto->cadastrar();
    if($result){
        echo '<script> alert("Produto cadastrado com sucesso!!") </script>';
    }else{
        echo 'Error';
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PrOdUtOs</title>
    <style>
        #fotoproduto_perfil{
            width: 50%;
            border-radius:50%;
        }
    </style>
</head>
<body>
    <h1> Cadastrar Produto </h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nome" id="nome" placeholder="Digite o nome do produto">
        <br>
        <input type="text" name="descricao" id="descricao"  placeholder="Digite a descrição do produto">
        <br>
        <input type="text" name="quantidade" id="quantidade"  placeholder="Digite a quantidade">
        <br>
        <input type="text" name="preco_unid" id="preco"  placeholder="Digite o preco_unid do produto">
        <br>
        <input type="file" name="fotoproduto" id="fotoproduto">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar Produto">
        <br>
    </form>

    <br>
    <h3> Produtos Cadastrados </h3>
    <table border="1">
        <tr>
            <td>Id</td>
            <td>fotoproduto</td>
            <td>NOME</td>
            <td>DESCRIÇÃO</td>
            <td>QUANTIDADE</td>
            <td>preco_unid</td>
            <td> Editar </td>
            <td> Excluir </td>
        </tr>
        <?php
            foreach($produtos_banco as $produto){
                echo '
                <tr>
                    <td> '.$produto['id_produto'].'  </td>
                    <td> <img id="fotoproduto_perfil" src="'.$produto['fotoproduto'].'">  </td>
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