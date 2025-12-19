<?php

class Categoria
{
    private $id;
    private $nombre;
    private $db;

    public function __construct()
    {
        // Al instanciar el modelo, nos conectamos a la BD automáticamente
        $this->db = Database::connect();
    }

    // --- GETTERS Y SETTERS (Para obtener y guardar valores en las propiedades) ---
    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        // $this->db->real_escape_string es seguridad básica para evitar inyecciones SQL
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    // --- MÉTODOS DE LÓGICA DE NEGOCIO ---

    public function getAll()
    {
        // Sacamos todas las categorías ordenadas por ID descendente
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
        return $categorias;
    }

    public function save()
    {
        // Escapamos el nombre por seguridad
        $nombre = $this->db->real_escape_string($this->nombre);

        // Insertamos: ID (null autoincrement), NOMBRE
        $sql = "INSERT INTO categorias VALUES(NULL, '{$nombre}');";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function getOne()
    {
        $categoria = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()}");
        return $categoria;
    }
}
