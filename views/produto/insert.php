<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $produto = new Produto();
    $produto->setDescricao($_POST['descricao']);
    $produto->setValorUnitario($_POST['valor_unitario']);
    $produto->setQuantidade($_POST['quantidade']);

    // Inserir no Banco de Dados
    $dao = new ProdutoDAO();
    $dao->create($produto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');