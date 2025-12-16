<?php

require_once 'models/Producto.php';
require_once 'models/Categoria.php'; //<---- Añade esto

class ProductoController
{

    public function index()
    {
        // Instanciamos el modelo
        $producto = new Producto();

        // Pedimos 6 productos aleatorios
        $productos = $producto->getRandom(6);

        // Renderizamos la vista pasándole los datos
        require_once 'views/producto/destacados.php';
    }

    // Acción para gestionar productos (SOLO ADMIN)
    public function gestion()
    {
        Utils::isAdmin(); // Seguridad

        $producto = new Producto();
        $productos = $producto->getAll(); // Sacamos todos

        require_once 'views/producto/gestion.php';
    }

    // Acción para mostrar el formulario de crear (SOLO ADMIN)
    public function crear()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();

        if (isset($_POST)) {
            // Instanciamos el modelo
            $producto = new Producto();

            // Asignamos los valores básicos
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setPrecio($_POST['precio']);
            $producto->setStock($_POST['stock']);
            $producto->setCategoria_id($_POST['categoria']);

            // --- GESTIÓN DE LA IMAGEN ---
            // Verificamos si llega un archivo por $_FILES
            if (isset($_FILES['imagen'])) {
                $file = $_FILES['imagen'];
                $filename = $file['name']; // Nombre original del archivo 
                $mimetype = $file['type']; // Tipo MIME: image/jpeg, image/png, image/gif

                // Validamos que sea una imagen real (jpg, jpeg, png, gif)
                if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                    // Comprobamos si existe el directorio 'uploads/images', si no, lo creamos
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }

                    // MOVER ARCHIVO: De la carpeta temporal a nuestra carpeta de destino
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);

                    // Guardamos el nombre del archivo en el modelo
                    $producto->setImagen($filename);
                }
            }
            // -----------------------------

            // Guardamos en la BD
            $save = $producto->save();

            if ($save) {
                $_SESSION['producto'] = "complete";
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }

        // Redirigimos al listado
        header('Location:' . base_url . 'producto/gestion');
    }
}
