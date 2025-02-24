<?php
require './Entity/Cliente.php';

// $dados = new Cliente('','','');
$dados = new Cliente();
$clientes_banco = $dados->buscar();

if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    // $cliente = new Cliente($nome,$cpf,$email);
    $cliente = new Cliente();
    $cliente->nome = $nome;
    $cliente->cpf = $cpf;
    $cliente->email = $email;
    $result = $cliente->cadastrar();
    if($result){
        echo '<script> alert("Cliente cadastrado com sucesso!!") </script>';
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
    <h1> Cadastrar Cliente </h1>
    <form method="POST">
        <input type="text" name="nome" id="nome" placeholder="Digite seu nome">
        <br>
        <input type="text" name="cpf" id="cpf"  placeholder="Digite seu CPF">
        <br>
        <input type="text" name="email" id="email"  placeholder="Digite seu e-mail">
        <br>
        <input type="submit" name="cadastrar" value="Cadastrar">
        <br>
    </form>

    <br>
    <h3> Clientes Cadastrados </h3>
    <table>
        <tr>
            <td>Id</td>
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
                    <td> '.$cliente['nome'].'  </td>
                    <td> '.$cliente['cpf'].'  </td>
                    <td> <a href="editar_cliente.php?id_cliente='.$cliente['id'].'"> Editar </a>  </td>
                    <td> <a href="./excluir_cliente.php?id_cliente='.$cliente['id'].'"> Excluir </a>  </td>
                </tr>
                ';
            }
        ?>
    </table>
</body>
</html>