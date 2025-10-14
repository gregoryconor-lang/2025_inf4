<?php
    class Produto {
        // Atributos
        private $id;
        private $descricao;
        private $valorUnitario;
        private $quantidade;
        private $tipoProduto; // Associação com a classe TipoProduto

        // Métodos
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getValorUnitario() {
            return $this->valorUnitario;
        }

        public function setValorUnitario($valorUnitario) {
            $this->valorUnitario = $valorUnitario;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }
        
        // Get e set do atributo que faz associação (normal)
        public function getTipoProduto() {
            return $this->tipoProduto;
        }

        public function setTipoProduto($tipoProduto) {
            $this->tipoProduto = $tipoProduto;
        }

        // Método para retornar uma string do objeto
        public function __toString() {
            return $this->descricao;
        }
    }