<?php
    class UsuarioDAO {
        public function read() {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM usuario");

                if(!$query->execute())
                    print_r($query->errorInfo());

                $usuarios = array();
                foreach($query->fetchAll(PDO::FETCH_ASSOC) as $linha) {
                    $usuario = new Usuario();
                    $usuario->setId($linha['id_usuario']);
                    $usuario->setEmail($linha['email']);
                    $usuario->setSenha($linha['senha']);

                    array_push($usuarios,$usuario);
                }

                return $usuarios;
            }
            catch(PDOException $e) {
                echo "Erro #2: " . $e->getMessage();
            }
        }

        public function find($id) {
            try {
                $query = BD::getConexao()->prepare("SELECT * FROM usuario WHERE id_usuario = :i");
                $query->bindValue(':i',$id, PDO::PARAM_INT);
                

                if(!$query->execute())
                    print_r($query->errorInfo());

                $linha = $query->fetch(PDO::FETCH_ASSOC);
                
                $usuario = new Usuario();
                $usuario->setId($linha['id_usuario']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);

                return $usuario;
            }
            catch(PDOException $e) {
                echo "Erro #3: " . $e->getMessage();
            }
        }
    }