<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800" rel="stylesheet">
    <base href="<?= base_url() ?>/">
    <title>Auditoria</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/estilo.css">

    <!--   <script src="js/main.js"></script> -->

    <style>
        * {
            font-family: 'Nunito', sans-serif;
        }

        .miNav {
            background: #000;
        }

        .miNav a {
            color: white;
        }

        .miDrop {
            list-style-type: none;
            padding-top: 8px;
        }

        .miDrop:hover a {
            color: white !important;
        }

        .miDrop a {
            color: white !important;
            cursor: pointer;
            text-decoration: none;
        }

        .miDrop:hover ul {
            display: block;
        }
        .ui-menu.ui-widget.ui-widget-content.ui-autocomplete.ui-front{
            max-height: 250px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php

    ?>
    <nav class="navbar navbar-expand-lg miNav navbar-dark" style="height: 39px">
        <div class="container-fluid">
        <!--     <a class="navbar-brand" href="admin">Dashboard</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin">Frecuencia</a>
                    </li>

                

                    <?php if ($_SESSION["personal"]["idCargo"] == "2" || $_SESSION["personal"]["idCargo"] == "1") : ?>
                        <ul class="miDrop">

                            <li>
                                <a class="text-white">
                                <i class="bi bi-caret-down-fill"></i> Maestros
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">

                                    <li><a class="dropdown-item" href="admin/frecuencia">Frecuencia</a></li>
                                    <li><a class="dropdown-item" href="admin/contrato">Contrato</a></li>
                                    <li><a class="dropdown-item" href="admin/programacion">Programación de Rutas</a></li>
                                    <li><a class="dropdown-item" href="admin/programacionRuta">Configuración de Rutas</a></li>
                                    <li><a class="dropdown-item" href="admin/categoria">Categoria</a></li>
                                    <li><a class="dropdown-item" href="admin/producto">Producto</a></li>
                                    <li><a class="dropdown-item" href="admin/canal">Canal</a></li>
                                    <li><a class="dropdown-item" href="admin/zona">Zona</a></li>
                                    <li><a class="dropdown-item" href="admin/local">Negocios</a></li>
                                    <li><a class="dropdown-item" href="admin/ruta">Rutas</a></li>
                                    <li><a class="dropdown-item" href="admin/personal">Auditores</a></li>
                                </ul>
                            </li>
                        </ul>
                    <?php endif; ?>


                </ul>


                <ul class="miDrop">

                    <li>
                        <a class="text-white">
                            <?php
                            if ($_SESSION["personal"]["idCargo"] == "1") {
                                $cargo = "";
                            } else if ($_SESSION["personal"]["idCargo"] == "2") {
                                $cargo = "";
                            } else if ($_SESSION["personal"]["idCargo"] == "3") {
                                $cargo = "";
                            } else {
                                $cargo = "";
                            }
                            ?>

                            <?= $_SESSION["personal"]["nombres"] . " " . $_SESSION["personal"]["apellidoPaterno"] . " " . $_SESSION["personal"]["apellidoMaterno"] . " - " . $cargo ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="admin/logout"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container-fluid">
        <?php echo $body ?>
    </div>


</body>

</html>