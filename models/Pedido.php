<?php

class Pedido
{
    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // GETTERS Y SETTERS BÁSICOS

    function getId()
    {
        return $this->id;
    }
    function setId($id)
    {
        $this->id = $id;
    }

    function getUsuario_id()
    {
        return $this->usuario_id;
    }
    function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }

    function getProvincia()
    {
        return $this->provincia;
    }
    function setProvincia($provincia)
    {
        $this->provincia = $this->db->real_escape_string($provincia);
    }

    function getLocalidad()
    {
        return $this->localidad;
    }
    function setLocalidad($localidad)
    {
        $this->localidad = $this->db->real_escape_string($localidad);
    }

    function getDireccion()
    {
        return $this->direccion;
    }
    function setDireccion($direccion)
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function getCoste()
    {
        return $this->coste;
    }
    function setCoste($coste)
    {
        $this->coste = $coste;
    }

    function getEstado()
    {
        return $this->estado;
    }
    function setEstado($estado)
    {
        $this->estado = $estado;
    }

    // --- MÉTODOS DE GUARDADO ---

    // 1. Guardar la cabecera del pedido
    public function save()
    {
        $sql = "INSERT INTO pedidos VALUES(NULL, {$this->getUsuario_id()}, '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    // 2. Guardar las líneas (los productos)
    public function save_linea()
    {
        // A. Obtener el ID del último pedido insertado (el que acabamos de crear en save())
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        // B. Recorrer el carrito de la sesión
        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            // C. Insertar en la tabla lineas_pedidos
            // Estructura: id, pedido_id, producto_id, unidades
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
            $save = $this->db->query($insert);
        }

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    // Saca el ÚLTIMO pedido registrado por un usuario específico
    public function getOneByUser()
    {
        $sql = "SELECT p.id, p.coste FROM pedidos p "
            . "WHERE p.usuario_id = {$this->getUsuario_id()} "
            . "ORDER BY id DESC LIMIT 1";

        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    // Saca la lista de productos vinculados a un pedido específico
    public function getProductosByPedido($id)
    {
        // SQL Complejo: Unimos productos con lineas_pedidos
        $sql = "SELECT p.*, lp.unidades FROM productos p "
            . "INNER JOIN lineas_pedidos lp ON p.id = lp.producto_id "
            . "WHERE lp.pedido_id = {$id}";

        $productos = $this->db->query($sql);
        return $productos;
    }

    // Obtener TODOS los pedidos de un usuario
    public function getAllByUser()
    {
        $sql = "SELECT * FROM pedidos "
            . "WHERE usuario_id = {$this->getUsuario_id()} "
            . "ORDER BY id DESC";

        $pedidos = $this->db->query($sql);

        return $pedidos;
    }

    // Obtener un pedido específico por su ID
    public function getOne()
    {
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()}";
        $producto = $this->db->query($sql);
        return $producto->fetch_object();
    }

    // ADMIN: Obtener TODOS los pedidos de la base de datos
    public function getAll()
    {
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }

    // ADMIN: Actualizar solo el estado de un pedido
    public function edit()
    {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' ";
        $sql .= " WHERE id={$this->getId()};";

        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }
}
