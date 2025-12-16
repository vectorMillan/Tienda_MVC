<h1>Gestión de Productos</h1>

<a href="<?= base_url ?>producto/crear" class="btn btn-success mb-3">Crear Producto</a>

<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>PRECIO</th>
            <th>STOCK</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($prod = $productos->fetch_object()): ?>
            <tr>
                <td><?= $prod->id; ?></td>
                <td><?= $prod->nombre; ?></td>
                <td><?= $prod->precio; ?></td>
                <td><?= $prod->stock; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>