<?php
require './DB/Database.php';

class Produto{

    public int $id_produto;
    public string $nome;
    public string $descricao;
    public string $quantidade;
    public string $preco_unid;
    public string $fotoproduto;

    public function cadastrar(){
        $db = new Database('produto');
        $result =  $db->insert(
                            [
                            'nome' => $this->nome,
                            'descricao' => $this->descricao,
                            'quantidade' => $this->quantidade,
                            'preco_unid' =>$this->preco_unid,
                            'fotoproduto' => $this->fotoproduto
                            ]
                        );
        
        if($result) {
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
            return (new Database('produto'))->update('id_produto ='.$this->id_produto,[
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'quantidade' => $this->quantidade,
                'preco_unid' => $this->preco_unid
            ]);
    }

    public static function buscar(){
        //FETCHALL
        return (new Database('produto'))->select()->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar_by_id($id_produto){
        //FETCHALL
        return (new Database('produto'))->select('id_produto = '. $id_produto)->fetchObject(self::class);
    }

    public function excluir($id_produto){
        return (new Database('produto'))->delete('id_produto = '.$id_produto);
    }

}



// $data = new Database('cliente');

// echo __DIR__ . '/teste';
// echo '<br>';

// print_r($data);