<?php
// Cargamos el modelo para poder usarlo
require_once 'models/Categoria.php';

class CategoriaController
{

    public function index()
    {
        // 1. Instanciamos el modelo
        $categoria = new Categoria();

        // 2. Usamos el método que creamos para sacar todas las filas de la BD
        $categorias = $categoria->getAll();

        // 3. Cargamos la vista que mostrará los datos
        // Nota: Pasamos la variable $categorias a la vista implícitamente
        require_once 'views/categoria/index.php';
    }
}
