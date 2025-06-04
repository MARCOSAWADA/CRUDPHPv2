<!-- http://localhost/projeto/CRUDPHPv2/cadastro_foto.php -->

<?php
require './Entity/Cliente.php';

$dados = new Cliente();
$clientes_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];


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

    // $arquivo = $_FILES['foto'];
    // if ($arquivo['error']) die("Falha ao enviar a foto");
    // $pasta = './upload/';
    // $nome_foto = $arquivo['name'];
    // $novo_nome = uniqid();

    // $extensao = strtolower(pathinfo($nome_foto, PATHINFO_EXTENSION));
    // if ($extensao != 'png' && $extensao != 'jpg') die("Falha ao enviar a foto");
    // $caminho = $pasta . $novo_nome . '.' . $extensao;
    // $foto = move_uploaded_file($arquivo['tmp_name'], $caminho);


    // _________________________________________________________________________

    $cliente = new Cliente();
    $cliente->nome = $nome;
    $cliente->cpf = $cpf;
    $cliente->email = $email;
        $cliente->foto = $caminho;
    $result = $cliente->cadastrar();
    if($result){
        echo '<script> alert("Cliente cadastrado com sucesso!!") </script>';
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
    <title>ClIeNtE</title>
    <style>
        #foto_perfil {
            width: 130px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover; /* Garante que a imagem não distorça */
        }
    </style>
</head>
<body>
    <h1> Cadastrar Cliente </h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome">
        <br>
        <input type="text" name="cpf" id="cpf"  placeholder="Digite seu CPF">
        <br>
        <input type="text" name="email" id="email"  placeholder="Digite seu e-mail">
        <br>
        <input type="file" name="foto" id="foto">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
    </form>

    <br>
    <h3> Clientes Cadastrados </h3>
    <table border="1">
        <tr>
            <td>Id</td>
            <td>Foto</td>
            <td>Nome</td>
            <td>CPF</td>
            <td> Editar </td>
            <td> Excluir </td>
        </tr>
        <?php
            foreach($clientes_banco as $cliente){
                echo '
                <tr>
                    <td> '.$cliente['id'].'  </td>
                    <td> <img id="foto_perfil" src="'.$cliente['foto'].'">  </td>
                    <td> '.$cliente['nome'].'  </td>
                    <td> '.$cliente['cpf'].'  </td>
                    <td> <a href="editar_cliente.php?id_cliente='.$cliente['id'].'"> Editar </a>  </td>
                    <td> <a href="./excluir_cliente.php?id_cliente='.$cliente['id'].'"> Excluir </a>  </td>
                </tr>
                ';
            }
        ?>
    </table>


                        <!-- ESTE ENDEREÇO COPIA DO WORKBENCH -->
    <!-- <img src="./upload/67bc72ed82a8e.jpg"> -->

</body>
</html>