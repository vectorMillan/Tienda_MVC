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

                    // --- NUEVO: VACIAR EL CARRITO TRAS COMPRA EXITOSA ---
                    // Si no hacemos esto, el usuario sigue teniendo los productos pendientes
                    if (isset($_SESSION['carrito'])) {
                        unset($_SESSION['carrito']);
                    }
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

    public function confirmado()
    {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($identity->id);

            // 1. Obtener los datos del pedido recién creado
            $pedido = $pedido->getOneByUser();

            // 2. Obtener los productos de ese pedido
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos()
    {
        // Seguridad: Solo usuarios logueados
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id;

            // Sacar los pedidos del usuario
            $pedido = new Pedido();
            $pedido->setUsuario_id($usuario_id);
            $pedidos = $pedido->getAllByUser();

            require_once 'views/pedido/mis_pedidos.php';
        } else {
            header("Location:" . base_url);
        }
    }

    public function detalle()
    {
        if (isset($_SESSION['identity'])) {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                // 1. Sacar los datos del pedido (Dirección, estado, etc)
                $pedido = new Pedido();
                $pedido->setId($id);
                $pedido = $pedido->getOne();

                // 2. Sacar los productos
                $pedido_productos = new Pedido();
                $productos = $pedido_productos->getProductosByPedido($id);

                require_once 'views/pedido/detalle.php';
            } else {
                header("Location:" . base_url . "pedido/mis_pedidos");
            }
        } else {
            header("Location:" . base_url);
        }
    }
}
