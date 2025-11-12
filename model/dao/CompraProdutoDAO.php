<?php
    class CompraProdutoDAO {
        public function create($compraProduto) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO compra(id_compra, id_produto, quantidade, valor_unitario_compra) 
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

        public function read($idCompra) {
            try {
                $query = BD::getConexao()->prepare("");
                $query->bindValue(':c',$id, PDO::PARAM_INT);                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $compraProdutos = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Fornecedor
                    $daoFornecedor = new FornecedorDAO();
                    $fornecedor = $daoFornecedor->find($linha['id_fornecedor']);
                    
                    // Para a associação com o Usuário
                    $daoUsuario = new UsuarioDAO();
                    $usuario = $daoUsuario->find($linha['id_usuario']);

                    // Construindo um objeto do compra
                    $compraProduto = new Compra();
                    $compraProduto->setId($linha['id_compra']);
                    $compraProduto->setData($linha['data']);
                    $compraProduto->setCompra($fornecedor);
                    // Definir o atributo (objeto) fornecedor
                    $compraProduto->setProduto($usuario);

                    array_push($compraProdutos,$compraProduto);
                }

                return $compraProdutos;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function destroy($id) {
            try {
                $query = BD::getConexao()->prepare(
                    "DELETE FROM compra 
                     WHERE id_compra = :i"
                );
                $query->bindValue(':i',$id, PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #5: " . $e->getMessage();
            }
        }
    }