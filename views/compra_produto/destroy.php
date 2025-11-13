<?php
    require "../../autoload.php";

    // Excluir do Banco de Dados
    $dao = new CompraProdutoDAO();
    $dao->destroy($_GET['idCompra'],$_GET['idProduto']);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: create.php?id=' . $_GET['idCompra']);