<?php
    class Compra {
        // Atributos
        private $id;
        private $data;
        private $fornecedor; // Associação com a classe Fornecedor
        private $usuario; // Associação com a classe Usuário

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getData() {
            return $this->data;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function getFornecedor() {
            return $this->fornecedor;
        }

        public function setFornecedor($fornecedor) {
            $this->fornecedor = $fornecedor;
        }

        public function getUsuario() {
            return $this->usuario;
        }

        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }
    }