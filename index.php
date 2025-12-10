<?php
session_start();
require_once 'config/db.php';
require_once 'config/parameters.php'; // Cargamos la url base

// Cargar la vista (Estructura visual)
require_once 'views/layout/header.php';

// AQUÍ IRÁ EL CONTENIDO CENTRAL CAMBIANTE
echo "<h1>Bienvenido a mi Tienda</h1>";
echo "<p>Aquí cargaremos los productos próximamente.</p>";

require_once 'views/layout/footer.php';
