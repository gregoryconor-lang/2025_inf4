<?php
    class CompraProdutoDAO {
        public function create($compraProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO compra_produto(id_compra, id_produto, quantidade, valor_unitario_compra) 
                     VALUES (:c, :p, :q, :v)"
                );
                $query->bindValue(':q',$compraProduto->getQuantidade(), PDO::PARAM_INT);
                $query->bindValue(':v',$compraProduto->getValorUnitario(), PDO::PARAM_STR);
                
                // Bind para as chaves estrangeiras
                $query->bindValue(':c',$compraProduto->getCompra()->getId(), PDO::PARAM_INT);
                $query->bindValue(':p',$compraProduto->getProduto()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        // Método read deverá filtrar produtos a partir de um id de compra
        public function read($idCompra) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM compra_produto WHERE id_compra = :c");
                $query->bindValue(':c',$idCompra, PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $compraProdutos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Produto
                    $daoProduto = new ProdutoDAO();
                    $produto = $daoProduto->find($linha['id_produto']);  
                    $compra = new Compra();
                    $compra->setId($idCompra);                  

                    // Construindo um objeto do compra
                    $compraProduto = new CompraProduto();
                    $compraProduto->setCompra($compra);                    
                    $compraProduto->setProduto($produto);

                    $compraProduto->setValorUnitario($linha['valor_unitario_compra']);
                    $compraProduto->setQuantidade($linha['quantidade']);

                    array_push($compraProdutos,$compraProduto);
                }

                return $compraProdutos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        // Método destroy irá apagar um registro a partir da combinação das duas chaves primárias
        public function destroy($idCompra, $idProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM compra_produto 
                     WHERE id_compra = :c and id_produto = :p"
                );
                $query->bindValue(':c',$idCompra, PDO::PARAM_INT);
                $query->bindValue(':p',$idProduto, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }