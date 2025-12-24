# 🛒 Tienda MVC - E-commerce con PHP

Una tienda online completa desarrollada con **PHP puro orientado a objetos**, implementando el patrón de diseño de software **MVC (Modelo-Vista-Controlador)**. Este proyecto demuestra una arquitectura limpia y escalable para aplicaciones web de comercio electrónico.

## 📋 Descripción

Sistema de e-commerce full-stack que permite a los usuarios navegar productos, gestionar un carrito de compras, realizar pedidos y a los administradores gestionar el inventario, categorías y pedidos. El proyecto está construido sin frameworks, utilizando PHP nativo con orientación a objetos y siguiendo las mejores prácticas del patrón MVC.

## ✨ Características Principales

### 👤 **Gestión de Usuarios**
- ✅ Registro de nuevos usuarios con validación
- ✅ Sistema de login/logout con sesiones seguras
- ✅ Roles de usuario: Cliente y Administrador
- ✅ Protección de rutas según permisos

### 🛍️ **Catálogo de Productos**
- ✅ Visualización de productos con imágenes
- ✅ Filtrado por categorías
- ✅ Búsqueda y navegación intuitiva
- ✅ Vista detallada de cada producto

### 🛒 **Carrito de Compras**
- ✅ Agregar/eliminar productos del carrito
- ✅ Ajustar cantidades
- ✅ Cálculo automático de totales
- ✅ Persistencia del carrito en sesión

### 📦 **Sistema de Pedidos**
- ✅ Confirmación de pedidos con datos de envío
- ✅ Historial de pedidos del usuario
- ✅ Vista detallada de cada pedido
- ✅ Actualización automática de stock tras compra

### 🔧 **Panel de Administración**
- ✅ **Gestión de Productos**: Crear, editar, eliminar productos
- ✅ **Gestión de Categorías**: CRUD completo de categorías
- ✅ **Gestión de Pedidos**: Ver todos los pedidos, cambiar estados
- ✅ **Carga de Imágenes**: Upload de imágenes de productos
- ✅ **Control de Stock**: Gestión de inventario automática

### 🎨 **Interfaz de Usuario**
- ✅ Diseño responsive con Bootstrap 5
- ✅ Navegación intuitiva
- ✅ Mensajes de feedback al usuario
- ✅ Formularios validados

## 🏗️ Arquitectura del Proyecto

```
Tienda_MVC/
│
├── assets/              # Archivos estáticos (CSS, JS, imágenes)
├── config/
│   ├── db.php          # Configuración de base de datos
│   └── parameters.php  # Parámetros globales
│
├── controllers/        # Controladores MVC
│   ├── CarritoController.php
│   ├── CategoriaController.php
│   ├── ErrorController.php
│   ├── PedidoController.php
│   ├── ProductoController.php
│   └── UsuarioController.php
│
├── models/            # Modelos de datos
│   ├── Categoria.php
│   ├── Pedido.php
│   ├── Producto.php
│   └── Usuario.php
│
├── views/             # Vistas (HTML + PHP)
│   ├── carrito/
│   ├── categoria/
│   ├── layout/       # Header y Footer
│   ├── pedido/
│   ├── producto/
│   └── usuario/
│
├── helpers/
│   └── Utils.php     # Funciones auxiliares
│
├── uploads/          # Archivos subidos (imágenes)
├── autoload.php      # Autocarga de clases
├── index.php         # Punto de entrada
└── .htaccess         # Configuración Apache (URL amigables)
```

## 🛠️ Tecnologías Utilizadas

| Tecnología | Versión | Uso |
|------------|---------|-----|
| **PHP** | 7.4+ | Backend y lógica de negocio |
| **MySQL** | 5.7+ | Base de datos |
| **Bootstrap** | 5.x | Framework CSS |
| **Apache** | 2.4+ | Servidor web |
| **MVC Pattern** | - | Arquitectura de software |

## 📊 Estructura de la Base de Datos

El sistema utiliza 5 tablas principales:

- **usuarios**: Información de usuarios (clientes y administradores)
- **categorias**: Categorías de productos
- **productos**: Catálogo de productos con stock
- **pedidos**: Información de pedidos realizados
- **lineas_pedidos**: Detalle de productos por pedido (relación N:M)

## ⚙️ Instalación y Configuración

### Requisitos Previos
- XAMPP/WAMP/LAMP instalado
- PHP >= 7.4
- MySQL >= 5.7
- Apache con mod_rewrite habilitado

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/TU_USUARIO/tienda_mvc.git
   cd tienda_mvc/Tienda_MVC
   ```

2. **Configurar la base de datos**
   - Crear una base de datos llamada `tienda_master` en MySQL
   - Importar el esquema de base de datos (crear las tablas necesarias)
   
   ```sql
   CREATE DATABASE tienda_master;
   ```

3. **Configurar la conexión**
   - Editar `config/db.php` con tus credenciales:
   ```php
   $db = new mysqli('localhost', 'TU_USUARIO', 'TU_PASSWORD', 'tienda_master');
   ```

4. **Configurar parámetros**
   - Editar `config/parameters.php` y configurar la URL base:
   ```php
   define("base_url", "http://localhost/tienda_mvc/Tienda_MVC/");
   ```

5. **Configurar permisos**
   ```bash
   chmod 777 uploads/
   chmod 777 uploads/images/
   ```

6. **Acceder a la aplicación**
   - Abrir en el navegador: `http://localhost/tienda_mvc/Tienda_MVC/`

### Crear Usuario Administrador

Para acceder al panel de administración, necesitas crear un usuario con rol de administrador en la base de datos:

```sql
UPDATE usuarios SET rol = 'admin' WHERE email = 'tu_email@example.com';
```

## 🚀 Uso del Sistema

### Como Cliente:
1. **Registrarse** o **Iniciar sesión**
2. Navegar por el **catálogo de productos**
3. Agregar productos al **carrito**
4. **Confirmar pedido** con dirección de envío
5. Ver **historial de pedidos**

### Como Administrador:
1. Iniciar sesión con cuenta de administrador
2. Acceder a **Gestionar Productos** para CRUD de productos
3. Acceder a **Gestionar Categorías** para CRUD de categorías
4. Acceder a **Gestionar Pedidos** para ver y actualizar estados

## 🔐 Seguridad Implementada

- ✅ Sanitización de inputs con `real_escape_string()`
- ✅ Validación de sesiones
- ✅ Control de acceso basado en roles (RBAC)
- ✅ Validación de tipos de archivo para uploads
- ✅ Protección contra inyección SQL
- ✅ Uso de prepared statements en consultas críticas

## 📝 Funcionalidades Destacadas

### Sistema de Autoload
Implementa un autoloader personalizado para cargar controladores automáticamente:
```php
spl_autoload_register('controllers_autoload');
```

### Helper Utils
Clase auxiliar con métodos reutilizables:
- `showCategorias()`: Obtiene todas las categorías
- `statsCarrito()`: Calcula estadísticas del carrito
- `isAdmin()`: Verifica permisos de administrador
- `showStatus()`: Traduce estados de pedidos

### Gestión de Stock Automática
Al confirmar un pedido, el sistema automáticamente:
1. Guarda el pedido en la BD
2. Crea las líneas de pedido
3. **Disminuye el stock** de cada producto
4. Vacía el carrito

### Manejo de Imágenes
Sistema de upload con validación:
- Verifica tipos MIME permitidos (jpg, jpeg, png, gif)
- Crea directorios automáticamente
- Maneja actualizaciones (mantiene imagen antigua si no se sube nueva)

## 🎯 Patrones de Diseño Aplicados

1. **MVC (Model-View-Controller)**: Separación de responsabilidades
2. **Singleton**: Para la conexión a base de datos
3. **Front Controller**: `index.php` como punto de entrada único
4. **Helper/Utility Pattern**: Clase `Utils` para funciones auxiliares

## 📚 Aprendizajes y Buenas Prácticas

Este proyecto demuestra:
- ✅ Implementación completa del patrón MVC desde cero
- ✅ POO en PHP con encapsulación, herencia y polimorfismo
- ✅ Gestión de sesiones y autenticación
- ✅ CRUD completo en múltiples entidades
- ✅ Relaciones de base de datos (1:N, N:M)
- ✅ Upload y gestión de archivos
- ✅ Routing personalizado sin frameworks
- ✅ Código limpio y bien documentado

## 🐛 Solución de Problemas

### Error: "Class not found"
- Verificar que el archivo esté en la carpeta correcta
- Verificar que el nombre de la clase coincida con el nombre del archivo

### Error: "Failed to open stream"
- Verificar permisos de la carpeta `uploads/`
- Ejecutar: `chmod 777 uploads/`

### Error de conexión a MySQL
- Verificar credenciales en `config/db.php`
- Verificar que el servicio MySQL esté corriendo

## 👨‍💻 Autor

**Tu Nombre**
- GitHub: [@TU_USUARIO](https://github.com/vectorMillan)
- LinkedIn: [Tu Perfil](https://www.linkedin.com/in/victor-ag/)

## 🙏 Agradecimientos

Proyecto desarrollado como parte de mi portafolio de desarrollo web, demostrando habilidades en:
- Desarrollo Backend con PHP
- Arquitectura MVC
- Diseño de Bases de Datos
- Desarrollo Full-Stack

---

⭐ Si este proyecto te fue útil, considera darle una estrella en GitHub!
