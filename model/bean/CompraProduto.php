<?php
    class CompraProduto {
        // Atributos
        private $compra; // Associação com a classe Compra
        private $produto; // Associação com a classe Produto
        private $quantidade;
        private $valorUnitario;

        // Métodos
        public function getCompra() {
            return $this->compra;
        }

        public function setCompra($compra) {
            $this->compra = $compra;
        }

        public function getProduto() {
            return $this->produto;
        }

        public function setProduto($produto) {
            $this->produto = $produto;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }

        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }

        public function getValorUnitario() {
            return $this->valorUnitario;
        }

        public function setValorUnitario($valorUnitario) {
            $this->valorUnitario = $valorUnitario;
        }
    }