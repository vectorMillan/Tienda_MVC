<?php if (isset($_SESSION['identity'])): ?>

    <h1>Hacer pedido</h1>
    <p>
        <a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
    </p>

    <br />

    <h3>Dirección para el envío:</h3>

    <form action="<?= base_url . 'pedido/add' ?>" method="POST">

        <div class="mb-3">
            <label for="provincia" class="form-label">Provincia</label>
            <input type="text" name="provincia" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="localidad" class="form-label">Ciudad / Localidad</label>
            <input type="text" name="localidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>

        <input type="submit" value="Confirmar pedido" class="btn btn-primary" />

    </form>

<?php else: ?>

    <h1>Necesitas identificarte</h1>
    <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
    <br />
    <a href="<?= base_url ?>usuario/login" class="btn btn-dark">Ir al Login</a>

<?php endif; ?>