<h1>Gestión de Productos</h1>

<a href="<?= base_url ?>producto/crear" class="btn btn-success mb-3">Crear Producto</a>

<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
    <strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
    <strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
    <strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
            <th>CATEGORIA</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($prod = $productos->fetch_object()): ?>
            <tr>
                <td><?= $prod->id; ?></td>
                <td><?= $prod->nombre; ?></td>
                <td><?= $prod->precio; ?></td>
                <td><?= $prod->stock; ?></td>
                <td><?= $prod->categoria_id; ?></td>
                <td>
                    <a href="<?= base_url ?>producto/editar?id=<?= $prod->id; ?>" class="btn btn-warning">Editar</a>
                    <a href="<?= base_url ?>producto/borrar?id=<?= $prod->id; ?>" class="btn btn-danger">Borrar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>