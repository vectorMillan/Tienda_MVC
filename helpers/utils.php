<?php

class Utils
{
    public static function showCategorias()
    {
        require_once 'models/Categoria.php';
        $categoria = new Categoria(); // Instanciamos el modelo
        $categorias = $categoria->getAll(); // Usamos el método que creamos para sacar todas las filas de la BD
        return $categorias;
    }

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("Location:" . base_url);
        } else {
            return true;
        }
    }

    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            // Contamos cuántos tipos de productos hay
            // (Si quisieras sumar unidades totales, habría que recorrer el array sumando 'unidades')
            $stats['count'] = count($_SESSION['carrito']);

            foreach ($_SESSION['carrito'] as $producto) {
                // Multiplicamos precio * unidades
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }

        return $stats;
    }

    public static function showStatus($status)
    {
        $value = 'Pendiente';

        if ($status == 'confirm') {
            $value = 'Pendiente';
        } elseif ($status == 'preparation') {
            $value = 'En preparación';
        } elseif ($status == 'ready') {
            $value = 'Preparado para enviar';
        } elseif ($status == 'sended') {
            $value = 'Enviado';
        }

        return $value;
    }
}
