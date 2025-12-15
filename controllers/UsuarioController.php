<?php
require_once 'models/Usuario.php';

class UsuarioController
{

    // Acción 1: Mostrar el formulario
    public function registro()
    {
        require_once 'views/usuario/registro.php';
    }

    // Acción 2: Guardar el usuario
    public function save()
    {
        if (isset($_POST)) {
            // Verificar que llegan los datos obligatorios
            // (Aquí podrías añadir más validaciones: email válido, pass fuerte, etc.)

            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;

            if ($nombre && $apellidos && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                // Guardar en BD
                $save = $usuario->save();

                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        // Redireccionar al registro pase lo que pase para mostrar el mensaje
        header("Location:" . base_url . 'usuario/registro');
    }
}
