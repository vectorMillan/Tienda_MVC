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
                        <a class="nav-link active" href="<?= base_url ?>">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categoría 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categoría 2</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    Login / Registro
                </span>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">