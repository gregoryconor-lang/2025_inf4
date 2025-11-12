<?php
    class CompraDAO {
        public function create($compra) {
            try {
                $query = BD::getConexao()->prepare(
                    "INSERT INTO compra(data,id_fornecedor,id_usuario) 
                     VALUES (:d, :f, :u)"
                );
                $query->bindValue(':d',$compra->getData(), PDO::PARAM_STR);
                // Bind para as chaves estrangeiras
                $query->bindValue(':f',$compra->getFornecedor()->getId(), PDO::PARAM_INT);
                $query->bindValue(':u',$compra->getUsuario()->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #1: " . $e->getMessage();
            }
        }

        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM compra");                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $compras = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    // Para a associação com o Fornecedor
                    $daoFornecedor = new FornecedorDAO();
                    $fornecedor = $daoFornecedor->find($linha['id_fornecedor']);
                    
                    // Para a associação com o Usuário
                    $daoUsuario = new UsuarioDAO();
                    $usuario = $daoUsuario->find($linha['id_usuario']);

                    // Construindo um objeto do compra
                    $compra = new Compra();
                    $compra->setId($linha['id_compra']);
                    $compra->setData($linha['data']);
                    $compra->setFornecedor($fornecedor);
                    // Definir o atributo (objeto) fornecedor
                    $compra->setUsuario($usuario);

                    array_push($compras,$compra);
                }

                return $compras;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }
        
        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM compra WHERE id_compra = :i");
                $query->bindValue(':i', $id, PDO::PARAM_INT);             

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                
                // Para a associação com o Fornecedor
                $daoFornecedor = new FornecedorDAO();
                $fornecedor = $daoFornecedor->find($linha['id_fornecedor']);
                
                // Para a associação com o Usuário
                $daoUsuario = new UsuarioDAO();
                $usuario = $daoUsuario->find($linha['id_usuario']);

                // Construindo um objeto do compra
                $compra = new Compra();
                $compra->setId($linha['id_compra']);
                $compra->setData($linha['data']);
                $compra->setFornecedor($fornecedor);
                
                // Definir o atributo (objeto) fornecedor
                $compra->setUsuario($usuario);

                return $compra;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }

        public function update($compra) {
            try {
                $query = BD::getConexao()->prepare(
                    "UPDATE compra 
                     SET data = :d, id_fornecedor = :f, id_usuario = :u  
                     WHERE id_compra = :i"
                );
                $query->bindValue(':d',$compra->getData(), PDO::PARAM_STR);
                // Bind para as chaves estrangeiras
                $query->bindValue(':f',$compra->getFornecedor()->getId(), PDO::PARAM_INT);
                $query->bindValue(':u',$compra->getUsuario()->getId(), PDO::PARAM_INT);
                $query->bindValue(':i',$compra->getId(), PDO::PARAM_INT);

                if(!$query->execute())
                    print_r($query->errorInfo());
            }
            catch(PDOException $e) {
                echo "Erro #4: " . $e->getMessage();
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