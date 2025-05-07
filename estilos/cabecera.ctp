<header class="main-header">   
    <a href="#" class="logo">
        <span class="logo-mini"><b>CENTRO MEDICO</b></span>
        <span class="logo-lg">CENTRO MEDICO</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Menu emergente derecho --> 
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php
                        if (!empty($_SESSION['usu_imagen'])) {
                            echo $_SESSION['usu_imagen'];
                        } else {
                            echo "/taller3/images/user/user-default-2.png";
                        }
                        ?>" class="user-image" alt="SIN IMAGEN">
                        <span class="hidden-xs"><?php echo $_SESSION['usu_nick']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="<?php
                            if (!empty($_SESSION['usu_imagen'])) {
                                echo $_SESSION['usu_imagen'];
                            } else {
                                echo "/taller3/images/user/user-default-2.png";
                            }
                            ?>" 
                                 class="img-circle" alt="SIN FOTO">
                            <p>
                                <small> <b> CARGO: </b> 
                                    <?php
                                    if (!empty($_SESSION['id_cargo'])) {
                                        echo $_SESSION['car_descri'];
                                    } else {
                                        echo "SIN CARGO";
                                    }
                                    ?>
                                </small>
                            </p>
                        </li>
                        <!-- acciones dentro del menu emergente-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="/taller3/img/ayuda/manual.pdf" target="_blank" class="btn btn-default" style="color:blue;"> Ayuda </a>
                            </div>
                            <div class="pull-right">
                                <a href="/taller3" class="btn btn-default" style="color: red;"> Salir </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>