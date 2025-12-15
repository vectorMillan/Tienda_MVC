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

    // Muestra el formulario de login
    public function login()
    {
        require_once 'views/usuario/login.php';
    }

    // Recibe los datos y crea la sesión
    public function identificar()
    {
        if (isset($_POST)) {
            // Recogemos datos del formulario
            $usuario = new Usuario();
            $identity = $usuario->login($_POST['email'], $_POST['password']);

            if ($identity && is_object($identity)) {
                // ÉXITO: Creamos la sesión de identidad
                $_SESSION['identity'] = $identity;

                // Si es admin, creamos una sesión especial (opcional por ahora)
                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                // ERROR: Sesión de fallo
                $_SESSION['error_login'] = 'Identificación fallida !!';
            }
        }
        header("Location:" . base_url);
    }

    public function logout()
    {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }

        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }

        header("Location:" . base_url);
    }
}
