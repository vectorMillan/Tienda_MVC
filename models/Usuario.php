<?php

class Usuario
{
    // Propiedades privadas (mapean los campos de la tabla)
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // --- GETTERS Y SETTERS (Para mover datos) ---
    // (Resumido para no llenar la pantalla, imagina uno por cada campo)
    function getId()
    {
        return $this->id;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function getApellidos()
    {
        return $this->apellidos;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getRol()
    {
        return $this->rol;
    }
    function getImagen()
    {
        return $this->imagen;
    }

    function setId($id)
    {
        $this->id = $id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setApellidos($apellidos)
    {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    function setEmail($email)
    {
        $this->email = $this->db->real_escape_string($email);
    }
    function setRol($rol)
    {
        $this->rol = $rol;
    }
    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    // Setter especial para la contraseña
    function setPassword($password)
    {
        $this->password = $password;
    }

    // --- LÓGICA DE NEGOCIO ---

    public function save()
    {
        // 1. Cifrar la contraseña (Seguridad Senior)
        // password_hash crea un hash único e irreversible. 'PASSWORD_BCRYPT' es el algoritmo estándar robusto.
        // La opción 'cost' => 4 define cuantas veces se procesa (balance entre seguridad y velocidad).
        $password_segura = password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);

        // 2. Crear la consulta SQL
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->nombre}', '{$this->apellidos}', '{$this->email}', '{$password_segura}', 'user', NULL);";

        // 3. Ejecutar y devolver resultado
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login($email, $password)
    {
        $result = false;
        $email = $this->db->real_escape_string($email);

        // 1. Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            // 2. Sacar el objeto usuario de la BD
            $usuario = $login->fetch_object();

            // 3. Verificar la contraseña
            // password_verify comprueba si la contraseña escrita ($password) 
            // coincide con el hash guardado en la BD ($usuario->password)
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario; // Devolvemos el objeto completo del usuario
            }
        }

        return $result;
    }
}
