<h1>Carrito de la compra</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($carrito as $indice => $elemento):
                $producto = $elemento['producto'];
            ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" style="height: 50px;" />
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" style="height: 50px;" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver?id=<?= $producto->id ?>">
                            <?= $producto->nombre ?>
                        </a>
                    </td>
                    <td>
                        <?= $producto->precio ?> €
                    </td>
                    <td>
                        <?= $elemento['unidades'] ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>carrito/delete?index=<?= $indice ?>" class="btn btn-danger btn-sm">Quitar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="delete-carrito">
        <a href="<?= base_url ?>carrito/delete_all" class="btn btn-danger">Vaciar carrito</a>
        <a href="<?= base_url ?>pedido/hacer" class="btn btn-success">Confirmar pedido</a>
    </div>

<?php else: ?>
    <div class="alert alert-info">No tienes productos en el carrito.</div>
<?php endif; ?>