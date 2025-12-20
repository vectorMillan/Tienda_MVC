<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Master</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url ?>">Tienda Master</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url ?>">Inicio</a>
                    </li>

                    <?php $categorias = Utils::showCategorias(); ?>

                    <?php while ($cat = $categorias->fetch_object()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url ?>categoria/ver?id=<?= $cat->id ?>">
                                <?= $cat->nombre ?>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <?php $stats = Utils::statsCarrito(); ?>

                        <a class="nav-link" href="<?= base_url ?>carrito/index">
                            🛒 Carrito

                            <span class="badge bg-danger rounded-pill">
                                <?= $stats['count'] ?>
                            </span>
                        </a>
                    </li>

                    <?php if (!isset($_SESSION['identity'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url ?>usuario/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url ?>usuario/registro">Registrarse</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (isset($_SESSION['admin'])): ?>
                                    <li><a class="dropdown-item" href="<?= base_url ?>categoria/index">Gestionar Categorías</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url ?>producto/gestion">Gestionar Productos</a></li>
                                    <li><a class="dropdown-item" href="#">Gestionar Pedidos</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                <?php endif; ?>

                                <li><a class="dropdown-item" href="#">Mis Pedidos</a></li>
                                <li><a class="dropdown-item" href="<?= base_url ?>usuario/logout">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">