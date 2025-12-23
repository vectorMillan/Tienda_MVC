<h1>Gestionar Categorías</h1>

<a href="<?= base_url ?>categoria/crear" class="btn btn-success mb-3">Crear Categoría</a>

<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($cat = $categorias->fetch_object()): ?>
            <tr>
                <td><?= $cat->id; ?></td>
                <td><?= $cat->nombre; ?></td>
                <td>
                    <a href="<?= base_url ?>categoria/editar?id=<?= $cat->id; ?>" class="btn btn-warning">Editar</a>
                    <a href="<?= base_url ?>categoria/borrar?id=<?= $cat->id; ?>" class="btn btn-danger">Borrar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>