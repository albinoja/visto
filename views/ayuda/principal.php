<?php
@session_start();
include '../../models/conexion.php';
include '../../controllers/controllersFunciones.php';
$conn = conectar_db();

$sql = "SELECT * FROM categorias";

$result = $conn->query($sql);
$cont = 0;
?>
<div>
    <p class="Panel PanelCate"><b>Panel Ayuda</b></p>
</div>

<div class="video-container">
            <ul class="video-list" role="tree">
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Login</div>
                    <ul class="video-links" role="group">
                    <li><a href="file:///C:/Users/Admin/Desktop/Ciclo%202-2024/practica%20profesional/videos%20de%20ayuda/login.mp4" role="treeitem" target="_blank">Inicio de Sesión</a></li>

                        <li><a href="#" role="treeitem">Recuperar contraseña</a></li>
                        <li><a href="#" role="treeitem">Crear una nueva cuenta</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Ventas</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Realizar una venta</a></li>
                        <li><a href="#" role="treeitem">Gestionar devoluciones</a></li>
                        <li><a href="#" role="treeitem">Aplicar descuentos</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Usuarios</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Agregar nuevo usuario</a></li>
                        <li><a href="#" role="treeitem">Modificar permisos</a></li>
                        <li><a href="#" role="treeitem">Eliminar usuario</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Proveedores</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Agregar proveedor</a></li>
                        <li><a href="#" role="treeitem">Gestionar pedidos</a></li>
                        <li><a href="#" role="treeitem">Ver historial de compras</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Productos</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Agregar nuevo producto</a></li>
                        <li><a href="#" role="treeitem">Actualizar inventario</a></li>
                        <li><a href="#" role="treeitem">Gestionar precios</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Categorías</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Crear nueva categoría</a></li>
                        <li><a href="#" role="treeitem">Organizar productos por categoría</a></li>
                        <li><a href="#" role="treeitem">Eliminar categoría</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Reportes</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Generar reporte de ventas</a></li>
                        <li><a href="#" role="treeitem">Análisis de inventario</a></li>
                        <li><a href="#" role="treeitem">Reporte de ganancias</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Notas</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Crear nota</a></li>
                        <li><a href="#" role="treeitem">Organizar notas</a></li>
                        <li><a href="#" role="treeitem">Compartir notas</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Backup</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Realizar copia de seguridad</a></li>
                        <li><a href="#" role="treeitem">Restaurar desde backup</a></li>
                        <li><a href="#" role="treeitem">Programar backups automáticos</a></li>
                    </ul>
                </li>
                <li role="treeitem" aria-expanded="false">
                    <div class="category" tabindex="0">Ayuda</div>
                    <ul class="video-links" role="group">
                        <li><a href="#" role="treeitem">Contactar soporte</a></li>
                        <li><a href="#" role="treeitem">Preguntas frecuentes</a></li>
                        <li><a href="#" role="treeitem">Guía de uso rápido</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </main>

    <script>
        document.querySelectorAll('.category').forEach(category => {
            category.addEventListener('click', () => {
                const videoLinks = category.nextElementSibling;
                const listItem = category.parentElement;
                if (videoLinks.style.display === 'block') {
                    videoLinks.style.display = 'none';
                    category.classList.remove('active');
                    listItem.setAttribute('aria-expanded', 'false');
                } else {
                    videoLinks.style.display = 'block';
                    category.classList.add('active');
                    listItem.setAttribute('aria-expanded', 'true');
                }
            });

            category.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    category.click();
                }
            });
        });
    </script>