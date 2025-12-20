<?php
require_once 'models/Producto.php';

class CarritoController
{

    public function index()
    {
        // Validamos si hay carrito en la sesión
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }

        require_once 'views/carrito/index.php';
    }

    public function add()
    {
        // 1. Recogemos el ID del producto por la URL
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location: ' . base_url);
        }

        // 2. Comprobamos si el carrito ya existe en la sesión
        if (isset($_SESSION['carrito'])) {
            $counter = 0;

            // Recorremos el carrito para ver si el producto YA estaba añadido
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }

        // 3. Si el producto NO estaba en el carrito (o el carrito no existía)
        if (!isset($counter) || $counter == 0) {
            // Conseguir producto de la BD
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne()->fetch_object();

            // Añadir al carrito (Array asociativo)
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        // 4. Redirigimos al carrito (o a la página anterior)
        header("Location: " . base_url . "carrito/index");
    }

    public function delete_all()
    {
        unset($_SESSION['carrito']);
        header("Location: " . base_url . "carrito/index");
    }
}
