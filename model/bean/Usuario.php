<?php
    class Usuario {
        // Atributos
        private $id;
        private $email;
        private $senha; 

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function __toString() {
            return $this->email;
        }
    }