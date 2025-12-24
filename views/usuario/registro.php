<h1>Registrarse</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <div class="alert alert-success">Registro completado correctamente</div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <div class="alert alert-danger">Registro fallido, introduce bien los datos</div>
<?php endif; ?>

<?php Utils::deleteSession('register'); ?>


<form action="<?= base_url ?>usuario/save" method="POST">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <input type="text" name="apellidos" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required />
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required />
    </div>

    <button type="submit" class="btn btn-primary">Registrarse</button>
</form>

<a href="<?= base_url ?>usuario/login">Si ya tienes una cuenta, Inicia sesión aqui.</a>