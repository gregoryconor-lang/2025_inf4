<?php
    class TipoProdutoDAO {
        public function create($tipoProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO tipo_produto(descricao) 
                     VALUES (:d)"
                );
                $query->bindValue(':d',$tipoProduto->getDescricao(), PDO::PARAM_STR);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM tipo_produto");
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $tipoProdutos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $tipoProduto = new TipoProduto();
                    $tipoProduto->setId($linha['id_tipo_produto']);
                    $tipoProduto->setDescricao($linha['descricao']);

                    array_push($tipoProdutos,$tipoProduto);
                }

                return $tipoProdutos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM tipo_produto WHERE id_tipo_produto = :i");
                $query->bindValue(':i',$id, PDO::PARAM_INT);
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                
                $tipoProduto = new TipoProduto();
                $tipoProduto->setId($linha['id_tipo_produto']);
                $tipoProduto->setDescricao($linha['descricao']);


                return $tipoProdutos;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($tipoProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE tipo_produto
                     SET descricao = :d
                     WHERE id_tipo_produto = :i"
                );
                $query->bindValue(':d',$tipoProduto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':i',$tipoProduto->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM tipo_produto
                     WHERE id_tipo_produto = :i"
                );
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
            }
        }
    }