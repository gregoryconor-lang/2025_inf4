<?php
    require "../../autoload.php";

    // Construir o objeto do Produto
    $produto = new Produto();
    $produto->setDescricao($_POST['descricao']);
    $produto->setValorUnitario($_POST['valor_unitario']);
    $produto->setQuantidade($_POST['quantidade']);
    $produto->setId($_POST['id']);

    // Construir um objeto do TipoProduto
    $tipoProduto = new TipoProduto();
    $tipoProduto->setId($_POST['tipo_produto']);

    // Definir o tipoProduto (objeto da associação) na classe Produto
    $produto->setTipoProduto($tipoProduto);

    // Inserir no Banco de Dados
    $dao = new ProdutoDAO();
    $dao->update($produto);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');