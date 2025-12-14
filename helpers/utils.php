<?php

class Utils
{
    public static function showCategorias()
    {
        require_once 'models/Categoria.php';
        $categoria = new Categoria(); // Instanciamos el modelo
        $result = $categoria->getAll(); // Usamos el método que creamos para sacar todas las filas de la BD
        return $result;
    }
}
