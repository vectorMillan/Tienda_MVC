<h1>Algunos de nuestros productos</h1>

<div class="row">

    <?php while ($product = $productos->fetch_object()): ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100 shadow-sm">

                <?php if ($product->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" class="card-img-top" alt="<?= $product->nombre ?>" style="height: 200px; object-fit: contain; padding: 15px;">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" class="card-img-top" alt="Sin imagen" style="height: 200px; object-fit: contain; padding: 15px;">
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