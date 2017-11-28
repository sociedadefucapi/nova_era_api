<?php

class produtoDAO
{
    private $connection;

    public function __construct()
    {
        $this->connection = Conexao::getInstance()->getDb();
    }

    public function consultar( $id ) {
        if ($id != null) {
            $sql = "SELECT * FROM produto WHERE id = $id";
            $resultado = $this->connection->query($sql);
            $produto = $resultado->fetch_assoc();
            return $produto;
        }
        else {
            $sql = "SELECT * FROM produto";
            $resultado = $this->connection->query($sql);
            $produto = $resultado->fetch_all(MYSQLI_ASSOC);
            return $produto;
        }
    }
    public function cadastrar( $produto )
    {

        $nome       = $produto->getNome();
        $cod_barra = $produto->getCod_Barra();
        $setor     = $produto->getSetor();
        $preco   = $produto->getPreco();
        $disponibilidade = $produto->getDisponibilidade();
       

        // $sql = "SELECT * FROM produto WHERE nome = '$nome'";
        // $exists = $this->connection->query($sql);
        // if($exists->num_rows > 0){
        //     $return['message'] = "Já existe um produto com o nome $nome.";
        //     return $return;
        //     exit;
        // }

        $sql = "INSERT INTO produto (Nome, Cod_Barra, Setor, Preco, Status_Prod)
		VALUES  ('$nome', '$cod_barra', '$setor', '$preco', '$disponibilidade');";

        $resultado = $this->connection->query($sql);
        $novo_id = $this->connection->insert_id;

        $return['message'] = "O novo produto foi cadastrado. ID : $novo_id ";
        return $return;
    }
    public function alterar( $id, $produto ) {
        $sql = "SELECT * FROM produto WHERE id = $id";
        $exists = $this->connection->query($sql);

        if($exists->num_rows == 0){
            $return['message'] = "O produto informado não existe na base de dados.";
        } else {
            $nome       = $produto->getNome();
            $cod_barra = $produto->getCod_Barra();
            $setor     = $produto->getSetor();
            $preco   = $produto->getPreco();
            $disponibilidade = $produto->getDisponibilidade();
            
            $sql = "UPDATE produto SET nome = '$nome', cod_barra = $cod_barra, setor = $setor, preco = '$preco', disponibilidade = '$disponibilidade' WHERE id = $id;";
            $retorno = $this->connection->query($sql);
            if ($retorno) {
                $return['message'] = "Os dados do produto foram atualizados";
            } else {
                $return['message'] = "Não foi possivel atualizar o produto. Talvez um $nome já exista";
            }
        }
        return $return;
    }
    public function deletar( $produto )
    {
        $sql = "SELECT * FROM produto WHERE id = $produto";
        $exists = $this->connection->query($sql);

        if($exists->num_rows == 0){
            $return['message'] = "O produto informado não existe na base de dados.";
        } else {
            $sql = "DELETE FROM produto WHERE id = $produto";
            $retorno = $this->connection->query($sql);
            if($retorno){
                $return['message'] = "O produto foi removido.";
            } else {
                $return['message'] = "Não foi possível excluir o produto.";
            }
        }
        return $return;
    }
}

