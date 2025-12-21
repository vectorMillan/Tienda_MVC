<?php
// Necesitaremos acceder a los modelos de pedido más adelante
require_once 'models/Pedido.php';

class PedidoController
{

    public function hacer()
    {
        // 1. Renderizar la vista
        // Pero OJO: Solo queremos mostrarla si el usuario está logueado
        require_once 'views/pedido/hacer.php';
    }

    public function add()
    {
        // Solo procesamos si está logueado
        if (isset($_SESSION['identity'])) {

            // Recoger datos del formulario
            $usuario_id = $_SESSION['identity']->id;
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;

            // Obtener el coste total del carrito usando el Helper
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($provincia && $localidad && $direccion) {
                // Instanciar Modelo
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                // 1. Guardar datos maestros (Pedido)
                $save = $pedido->save();

                // 2. Guardar lineas (Productos)
                $save_linea = $pedido->save_linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }

            // Redirigir a la página de confirmación (la crearemos luego)
            header("Location:" . base_url . "pedido/confirmado");
        } else {
            // Si no está logueado, fuera
            header("Location:" . base_url);
        }
    }
}
