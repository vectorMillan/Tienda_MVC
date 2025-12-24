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
            // Recogemos los datos básicos
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                // --- LÓGICA DE IMAGEN (FILE UPLOAD) ---
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    // Validamos que sea una imagen real
                    if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {

                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }

                        // Movemos el archivo y guardamos el nombre en el objeto
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }

                // --- DECISIÓN: ¿INSERT O UPDATE? ---
                if (isset($_GET['id'])) {
                    // Estamos editando
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    // Estamos creando
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }

        header("Location:" . base_url . "producto/gestion");
    }

    public function borrar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION['delete'] = "complete";
            } else {
                $_SESSION['delete'] = "failed";
            }
        } else {
            $_SESSION['delete'] = "failed";
        }

        header("Location:" . base_url . "producto/gestion");
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);

            // Reutilizamos getOne para rellenar el formulario
            $pro = $producto->getOne()->fetch_object();

            require_once 'views/producto/crear.php';
        } else {
            header("Location:" . base_url . "producto/gestion");
        }
    }
}
