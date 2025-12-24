<h1>Login</h1>

<?php if (isset($_SESSION['error_login'])): ?>
    <div class="alert alert-danger">
        Identificación fallida
    </div>
    <?php Utils::deleteSession('error_login'); ?>
<?php endif; ?>

<form action="<?= base_url ?>usuario/identificar" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required />
    </div>

    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<a href="<?= base_url ?>usuario/registro">Si aun no tienes una cuenta, Registrate aqui.</a>