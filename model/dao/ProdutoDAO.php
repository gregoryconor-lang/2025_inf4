<?php
    class ProdutoDAO {
        public function create($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto(descricao,valor_unitario,quantidade) 
                     VALUES (:d, :v, :q)"
                );
                $query->bindValue(':d',$produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':v',$produto->getValorUnitario(), PDO::PARAM_STR);
                $query->bindValue(':q',$produto->getQuantidade(), PDO::PARAM_STR);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto");
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $produtos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $produto = new Produto();
                    $produto->setId($linha['id_produto']);
                    $produto->setDescricao($linha['descricao']);
                    $produto->setValorUnitario($linha['valor_unitario']);
                    $produto->setQuantidade($linha['quantidade']);

                    array_push($produtos,$produto);
                }

                return $produtos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
    }