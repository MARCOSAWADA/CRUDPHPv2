<?php

require './Entity/Cliente.php';

$id_recebido = $_GET['id_cliente'];


if(!isset($id_recebido) or !is_numeric($id_recebido)){
    header('location: index.php');
    exit;
}

$cliente = Cliente::buscar_by_id($id_recebido);
$nome = $cliente->nome;
$cpf = $cliente->cpf;
$email = $cliente->email;

if(isset($_POST['editar'])){
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];

    $cli_editado = new Cliente();
    $cli_editado->id = $id_recebido;
    $cli_editado->nome = $nome;
    $cli_editado->cpf = $cpf;
    $cli_editado->email = $email;

    $result = $cli_editado->atualizar();
    if($result){
        echo '<script> alert("Atualizado com sucesso!!!") </script>' ;
    }else{
        echo 'Erro ao atualizar';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Cadastro</h1>

     <form method="POST">
        <input name="nome" id="nome" type="text" value="<?= $nome;?>">
        <input name="cpf" id="cpf" type="text"  value="<?= $cpf;?>">
        <input name="email" id="email" type="email"  value="<?= $email;?>">
        <input name="editar" type="Submit" value="Editar">
     </form>

</body>
</html>