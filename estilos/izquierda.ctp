<aside class="main-sidebar" style="background-color:#50035c;">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php
                if (!empty($_SESSION['usu_imagen'])) {
                    echo $_SESSION['usu_imagen'];
                } else {
                    echo "/taller3/images/salud.png";
                }
                ?>" class="img-circle" alt="Imagen de Usuario">
            </div>
            <div class="pull-left info" style="font-size: 12px; padding-top: 20px;"><p></div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="/taller3/menu.php" class="fa fa-home"><span class="logo-lg"><strong> INICIO</strong></span></a></li>
            <?php $modulos = consultas::get_datos("select distinct(mod_cod),(mod_nombre) from v_permisos where gru_cod =" . $_SESSION['gru_cod'] . " order by mod_cod"); ?>  
            <?php if (!empty($modulos)) { ?>
                <?php foreach ($modulos as $modulo) { ?>
                    <li class="treeview">
                        <a href=""> 
                            <i class="fa fa-folder-o"></i> 
                            <span><?php echo $modulo['mod_nombre'] ?></span> 
                            <i class="fa fa-angle-double-right pull-right"></i> 
                        </a>
                        <?php $paginas = consultas::get_datos("select pag_direc,pag_nombre,leer,insertar,editar,borrar from v_permisos where mod_cod=" . $modulo['mod_cod'] . " and gru_cod =" . $_SESSION['gru_cod'] . " order by pag_cod"); ?>   
                        <ul class="treeview-menu" style="background-color:#9b59b6;">                             
                            <?php foreach ($paginas as $pagina) { ?>
                                <li>
                                    <a class="fa fa-folder-open" href="<?php echo $pagina['pag_direc']; ?>" style="transition: background-color 0.3s ease;">
                                        <?php echo " " . $pagina['pag_nombre']; ?>
                                    </a>     
                                </li>
                                <?php $_SESSION[$pagina['pag_nombre']] = $pagina; ?>
                            <?php } ?>  
                        </ul>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <b style="color: red; margin-left: 300px"> NO TIENE PERMISOS...</b>
            <?php } ?>
        </ul>
    </section>
</aside>

<style>
    .main-sidebar {
        height: 100%;
        position: fixed;
        overflow-y: auto;
    }
    .treeview-menu li a:hover, .sidebar-menu li a.active {
    background-color: #7b4397 !important; /* Color morado oscuro */
    color: #fff !important; /* Texto blanco para contraste */
}

    body {
        background-color: #50035c;
    }
</style>
