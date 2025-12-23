<?php if (isset($edit) && isset($cat) && is_object($cat)): ?>
    <h1>Editar categoría <?= $cat->nombre ?></h1>
    <?php $url_action = base_url . "categoria/save&id=" . $cat->id; ?>
<?php else: ?>
    <h1>Crear nueva categoría</h1>
    <?php $url_action = base_url . "categoria/save"; ?>
<?php endif; ?>

<form action="<?= $url_action ?>" method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la Categoría</label>
        <input type="text" name="nombre" class="form-control" required value="<?= isset($cat) ? $cat->nombre : '' ?>" />
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>