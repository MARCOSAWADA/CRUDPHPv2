<?php
require './Entity/Produto.php';

$dados = new Produto();
$produtos_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco_unid = $_POST['preço'];


    // ____CÓDIGO PARA CADASTRAR FOTOS NO SERVIDOR BANCO DE DADOS___________
    
    // print_r($_FILES);
    $arquivo = $_FILES['foto'];
    if ($arquivo['error']) die("Falha ao enviar a foto");
    $pasta = './upload/';

    //( $arquivo['name']; ) ao enviar a imagem, irá mostrar o nome do arquivo da imagem
    $nome_foto = $arquivo['name'];
    // echo $nome_foto;

    // ( uniqid(); )ao enviar a imagem, irá mostrar um novo nome do arquivo da imagem
    $novo_nome = uniqid();
    echo $novo_nome;

    // $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    // echo '<br> SOMENTE A EXTENSÃO' . $extensao;

    // $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    // if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a foto");
    // echo '<br> SOMENTE A EXTENSÃO' . $extensao;

    // $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    // if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a foto");
    // $path = $pasta . $novo_nome . '.' . $extensao;
    // echo '<br>CAMINHO: ' . $path;

    $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a foto");
    $caminho = $pasta . $novo_nome . '.' . $extensao;
    $foto = move_uploaded_file($arquivo['tmp_name'], $caminho);

    // ______________________________________________________________________

    $arquivo = $_FILES['foto'];
    if ($arquivo['error']) die("Falha ao enviar a foto");
    $pasta = './upload/';
    $nome_foto = $arquivo['name'];
    $novo_nome = uniqid();

    $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a foto");
    $caminho = $pasta . $novo_nome . '.' . $extensao;
    $foto = move_uploaded_file($arquivo['tmp_name'], $caminho);


    // _________________________________________________________________________

    $produto = new Produto();
    $produto->nome = $nome;
    $produto->descricao = $descricao;
    $produto->quantidade = $quantidade;
    $produto->preco_unid = $preco_unid;
        $produto->foto = $caminho;
    $result = $produto->cadastrar();
    if($result){
        echo '<script> alert("Produto cadastrado com sucesso!!") </script>';
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
    <title>PrOdUtOs</title>
    <style>
        #foto_perfil{
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
        <input type="text" name="preco_unid" id="preco"  placeholder="Digite o preço do produto">
        <br>
        <input type="file" name="foto" id="foto">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar Produto">
        <br>
    </form>

    <br>
    <h3> Produtos Cadastrados </h3>
    <table border="1">
        <tr>
            <td>Id</td>
            <td>FOTO</td>
            <td>NOME</td>
            <td>DESCRIÇÃO</td>
            <td>QUANTIDADE</td>
            <td>PREÇO</td>
            <td> Editar </td>
            <td> Excluir </td>
        </tr>
        <?php
            foreach($produtos_banco as $produto){
                echo '
                <tr>
                    <td> '.$produto['id'].'  </td>
                    <td> <img id="foto_perfil" src="'.$produto['foto'].'">  </td>
                    <td> '.$produto['nome'].'  </td>
                    <td> '.$produto['descricao'].'  </td>
                    <td> <a href="editar_produto.php?id_produto='.$produto['id'].'"> Editar </a>  </td>
                    <td> <a href="./excluir_produto.php?id_produto='.$produto['id'].'"> Excluir </a>  </td>
                </tr>
                ';
            }
        ?>
    </table>


                        <!-- ESTE ENDEREÇO COPIA DO WORKBENCH -->
    <!-- <img src="./upload/67bc72ed82a8e.jpg"> -->

</body>
</html>