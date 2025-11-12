<?php
    require "../../autoload.php";

    // Construir o objeto da Compra
    $compra = new Compra();
    $compra->setData($_POST['data']);
    
    // Construir um objeto do Fornecedor
    $fornecedor = new Fornecedor();
    $fornecedor->setId($_POST['fornecedor']);
    
    // Construir um objeto do Usuário
    $usuario = new Usuario();
    $usuario->setId($_POST['usuario']);

    // Definir o Fornecedor e Usuário (objetos das associações) na classe Compra
    $compra->setFornecedor($fornecedor);
    $compra->setUsuario($usuario);

    // Inserir no Banco de Dados
    $dao = new CompraDAO();
    $dao->create($compra);

    // Redirecionar para o index (Comentar quando não funcionar)
    header('Location: index.php');