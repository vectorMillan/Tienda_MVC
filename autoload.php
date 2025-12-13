<?php

function controllers_autoload($classname)
{
    // Entramos a la carpeta controllers y buscamos el archivo con el nombre de la clase + .php
    include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');
