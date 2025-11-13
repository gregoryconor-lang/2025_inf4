<?php
    require "../../autoload.php";

    // Construir o objeto da CompraProduto
    $compraProduto = new CompraProduto();
    $compraProduto->setQuantidade($_POST['quantidade']);
    $compraProduto->setValorUnitario($_POST['valor_unitario']);
    
    // Construir um objeto da Compra
    $compra = new Compra();
    $compra->setId($_POST['id']);
    
    // Construir um objeto do Produto
    $produto = new Produto();
    $produto->setId($_POST['produto']);

    // Definir o compra e Produto (objetos das associações) na classe CompraProduto
    $compraProduto->setCompra($compra);
    $compraProduto->setProduto($produto);

    // Inserir no Banco de Dados
    $dao = new CompraProdutoDAO();
    $dao->create($compraProduto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $compra->getId());