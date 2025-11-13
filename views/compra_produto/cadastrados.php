<?php
    require "../../autoload.php";

    $dao = new CompraProdutoDAO();
?>

<h2>Tabela de Cadastrados</h2>
<table class="table table-hover">
    <tr>
        <th>ID da Compra</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor Unitário</th>
        <th>Ações</th>
    </tr>
    <?php foreach($dao->read($idCompra) as $compraProduto) : ?>
        <tr>
            <td><?= $compraProduto->getCompra()->getId() ?></td>
            <td><?= $compraProduto->getProduto() ?></td>
            <td><?= $compraProduto->getQuantidade() ?></td>
            <td><?= $compraProduto->getValorUnitario() ?></td>
            <td>
                <a class="link link-danger" href="destroy.php?idCompra=<?= $idCompra ?>&idProduto=<?= $compraProduto->getProduto()->getId() ?>" title="Excluir">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    <?php endforeach ?>

</table>