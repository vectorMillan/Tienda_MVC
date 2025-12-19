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
}
