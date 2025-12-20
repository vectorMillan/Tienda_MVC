<?php if (isset($categoria)): ?>

    <h1><?= $categoria->nombre ?></h1>

    <?php if ($productos->num_rows == 0): ?>
        <p>No hay productos para mostrar en esta categoría</p>
    <?php else: ?>

        <div class="row">
            <?php while ($product = $productos->fetch_object()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($product->imagen != null): ?>
                            <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" class="card-img-top" style="height: 200px; object-fit: contain; padding: 15px;">
                        <?php else: ?>
                            <img src="<?= base_url ?>assets/img/gorra_azul.png" class="card-img-top" style="height: 200px; object-fit: contain; padding: 15px;">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column text-center">
                            <h5 class="card-title"><?= $product->nombre ?></h5>
                            <p class="card-text text-muted"><?= $product->precio ?> MXN</p>
                            <a href="<?= base_url ?>carrito/add?id=<?= $product->id ?>" class="btn btn-primary mt-auto">Comprar</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

    <?php endif; ?>

<?php else: ?>
    <h1>La categoría no existe</h1>
<?php endif; ?>