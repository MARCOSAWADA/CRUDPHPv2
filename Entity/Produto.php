<?php
require './DB/Database.php';

class Produto{

    public int $id_produto;
    public string $nome;
    public string $descricao;
    public string $quantidade;
    public string $preco_unid;
    public string $foto;

    public function cadastrar(){
        $db = new Database('produto');
        $result =  $db->insert(
                            [
                            'nome' => $this->nome,
                            'descricao' => $this->descricao,
                            'quantidade' => $this->quantidade,
                            'preco_unid' =>$this->preco_unid,
                            'foto' => $this->foto
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
            return (new Database('produto'))->update('id ='.$this->id,[
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'quantidade' => $this->quantidade
            ]);
    }

    public static function buscar(){
        //FETCHALL
        return (new Database('produto'))->select()->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar_by_id($id){
        //FETCHALL
        return (new Database('produto'))->select('id = '. $id)->fetchObject(self::class);
    }

    public function excluir($id){
        return (new Database('produto'))->delete('id = '.$id);
    }

}



// $data = new Database('cliente');

// echo __DIR__ . '/teste';
// echo '<br>';

// print_r($data);