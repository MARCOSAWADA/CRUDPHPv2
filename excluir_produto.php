<?php
require './Entity/Produto.php';

$cli = new Produto('','','');

$id = $_GET['id_produto'];

$result = $cli->excluir($id);

if($result){
    echo '<script> alert("produto excluido com sucesso!! ")  </script> ';
    echo "<meta http-equiv='refresh' content='0.5;url=cadastro_foto_produto.php'>";
}
else{
    echo '<script> alert("Erro ao excluir !! ")  </script> ';

}

