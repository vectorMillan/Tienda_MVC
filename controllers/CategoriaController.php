<?php
// Cargamos el modelo para poder usarlo
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

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

    // Muestra el formulario de creación (Solo para admins)
    public function crear()
    {
        Utils::isAdmin(); // El guardia verifica primero
        require_once 'views/categoria/crear.php';
    }

    // Guarda la categoría en la BD
    public function save()
    {
        Utils::isAdmin(); // El guardia verifica primero

        if (isset($_POST) && isset($_POST['nombre'])) {
            // Guardar la categoría
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }

        // Redirigir al listado
        header("Location:" . base_url . "categoria/index");
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria = $categoria->getOne()->fetch_object();

            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }
}
