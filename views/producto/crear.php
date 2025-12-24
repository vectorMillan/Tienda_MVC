<?php if (isset($edit) && isset($pro) && is_object($pro)): ?>
    <h1>Editar producto <?= $pro->nombre ?></h1>
    <?php $url_action = base_url . "producto/save?id=" . $pro->id; ?>
<?php else: ?>
    <h1>Crear nuevo producto</h1>
    <?php $url_action = base_url . "producto/save"; ?>
<?php endif; ?>

<div class="form_container">

    <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>" required />
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" value="<?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?>"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" step="0.01" class="form-control" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>" required />
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>" required />
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <?php $categorias = Utils::showCategorias(); ?>
            <select name="categoria" class="form-select">
                <?php while ($cat = $categorias->fetch_object()): ?>
                    <option value="<?= $cat->id ?>" <?= isset($pro) && is_object($pro) && $pro->categoria_id == $cat->id ? 'selected' : ''; ?>>
                        <?= $cat->nombre ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <br>
            <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
                <img src="<?= base_url ?>uploads/images/<?= $pro->imagen ?>" class="img-thumbnail" />
            <?php endif; ?>
            <input type="file" name="imagen" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>