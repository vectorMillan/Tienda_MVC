<h1>Crear nuevos productos</h1>

<div class="form_container">

    <form action="<?= base_url ?>producto/save" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select name="categoria" class="form-select">
                <?php while ($cat = $categorias->fetch_object()): ?>
                    <option value="<?= $cat->id ?>">
                        <?= $cat->nombre ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>