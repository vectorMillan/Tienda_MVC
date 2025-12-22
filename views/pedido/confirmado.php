<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>

    <h1>Tu pedido se ha confirmado</h1>
    <p>
        Tu pedido ha sido guardado con éxito, una vez que realices la transferencia
        bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.
    </p>
    <br />

    <?php if (isset($pedido)): ?>
        <h3>Datos del pedido:</h3>
        <br />
        Numero de pedido: <?= $pedido->id ?> <br />
        Total a pagar: <?= $pedido->coste ?> MXN <br />
        Productos:

        <table class="table table-bordered">
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while ($producto = $productos->fetch_object()): ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" style="height: 50px;" />
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" style="height: 50px;" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver?id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                    </td>
                    <td><?= $producto->precio ?> MXN</td>
                    <td><?= $producto->unidades ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

    <?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
    <h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>