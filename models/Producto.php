<?php

class Producto
{
    private $id;
    private $categoria_id; // FK: Llave foránea
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // --- GETTERS (Para sacar datos) ---
    function getId()
    {
        return $this->id;
    }
    function getCategoria_id()
    {
        return $this->categoria_id;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function getDescripcion()
    {
        return $this->descripcion;
    }
    function getPrecio()
    {
        return $this->precio;
    }
    function getStock()
    {
        return $this->stock;
    }
    function getOferta()
    {
        return $this->oferta;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function getImagen()
    {
        return $this->imagen;
    }

    // --- SETTERS (Para meter datos) ---
    function setId($id)
    {
        $this->id = $id;
    }
    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setDescripcion($descripcion)
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }
    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }
    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    // --- LÓGICA DE NEGOCIO ---

    public function getAll()
    {
        // Sacamos todos los productos ordenados por ID descendente
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC;");
        return $productos;
    }

    public function save()
    {
        // Preparamos los datos
        $nombre = $this->db->real_escape_string($this->nombre);
        $descripcion = $this->db->real_escape_string($this->descripcion);
        $imagen = $this->db->real_escape_string($this->imagen);

        // Construimos la consulta SQL (fíjate en el orden de las columnas de tu BD)
        // INSERT INTO productos VALUES(NULL, categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen)
        $sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$nombre}', '{$descripcion}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$imagen}');";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    // Obtener productos aleatorios para la portada
    public function getRandom($limit)
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function getAllCategory()
    {
        $sql = "SELECT p.*, c.nombre AS 'catnombre' 
                FROM productos p 
                INNER JOIN categorias c ON c.id = p.categoria_id 
                WHERE p.categoria_id = {$this->getCategoria_id()} 
                ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne()
    {
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto;
    }

    // Actualizar stock (Restar unidades vendidas)
    public function disminuirStock($unidades)
    {
        $sql = "UPDATE productos SET stock = stock - {$unidades} WHERE id = {$this->getId()}";
        $save = $this->db->query($sql);
        return $save;
    }
}
