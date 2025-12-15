<h1>Crear nueva categoría</h1>

<form action="<?= base_url ?>categoria/save" method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre de la Categoría</label>
        <input type="text" name="nombre" class="form-control" required />
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>