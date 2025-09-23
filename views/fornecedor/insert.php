<?php
    require "../../autoload.php";

    // Construir o objeto do Fornecedor
    $fornecedor = new Fornecedor();
    $fornecedor->setCnpj($_POST['cnpj']);
    $fornecedor->setRazaoSocial($_POST['razao_social']);
    $fornecedor->setEmail($_POST['email']);
    $fornecedor->setTelefone($_POST['telefone']);

    // Inserir no Banco de Dados
    $dao = new FornecedorDAO();
    $dao->create($fornecedor);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');