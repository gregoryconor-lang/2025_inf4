<?php
    class ProdutoDAO {
        public function create($produto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO produto(descricao,valor_unitario,quantidade,id_tipo_produto) 
                     VALUES (:d, :v, :q, :t)"
                );
                $query->bindValue(':d',$produto->getDescricao(), PDO::PARAM_STR);
                $query->bindValue(':v',$produto->getValorUnitario(), PDO::PARAM_STR);
                $query->bindValue(':q',$produto->getQuantidade(), PDO::PARAM_STR);
                // Bind para a chave estrangeira
                $query->bindValue(':t',$produto->getTipoProduto()->getId(), PDO::PARAM_INT);

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
                    // Para a associação com o TipoProduto
                    $daoProduto = new TipoProdutoDAO();
                    $tipoProduto = $daoProduto->find($linha['id_tipo_produto']);

                    // Construindo um objeto do Produto
                    $produto = new Produto();
                    $produto->setId($linha['id_produto']);
                    $produto->setDescricao($linha['descricao']);
                    $produto->setValorUnitario($linha['valor_unitario']);
                    $produto->setQuantidade($linha['quantidade']);
                    // Definir o atributo (objeto) TipoProduto
                    $produto->setTipoProduto($tipoProduto);

                    array_push($produtos,$produto);
                }

                return $produtos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM produto WHERE id_produto = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);             

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                // Para a associação com o TipoProduto
                $daoProduto = new TipoProdutoDAO();
                $tipoProduto = $daoProduto->find($linha['id_tipo_produto']);

                // Construindo um objeto do Produto
                $produto = new Produto();
                $produto->setId($linha['id_produto']);
                $produto->setDescricao($linha['descricao']);
                $produto->setValorUnitario($linha['valor_unitario']);
                $produto->setQuantidade($linha['quantidade']);
                // Definir o atributo (objeto) TipoProduto
                $produto->setTipoProduto($tipoProduto);

                return $produto;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }
    }