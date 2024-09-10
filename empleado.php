<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/" target="_blank">UMG</a>
                        </li>
                    
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                            <li><a class="dropdown-item" href="#">Nuevo</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Vacio</a></li>
                        </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Formulario de Empleados -->
    <div class="container">
        <h1>Formulario de Empleado</h1>
        <form  action="crud_empleado.php" method="post" class="form-group needs-validation" novalidate>
            <!-- ID -->
            <label for="lbl_id" class="form-label"><b>ID</b></label>
            <input type="text" class="form-control" name="txt_id" id="txt_id" value="0" readonly>

            <!-- Codigo E001 -->
            <label for="lbl_codigo" class="form-label"><b>Codigo</b></label>
            <input type="text" name="txt_codigo" id="txt_codigo" class="form-control"  placeholder="Ejemplo: E001" pattern="[E]{1}[0-9]{3}" required>

            <!-- Nombres -->
            <label for="lbl_nombres" class="form-label"><b>Nombres</b></label>
            <input type="text" name="txt_nombres" id="txt_nombres" class="form-control"  placeholder="Ejemplo: Nombre1 Nombre2"  required>

            <!-- Apellidos -->
            <label for="lbl_apellidos" class="form-label"><b>Apellidos</b></label>
            <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control"  placeholder="Ejemplo: Apellido1 Apellido2"  required>

            <!-- Dirección -->
            <label for="lbl_direccion" class="form-label"><b>Direccion</b></label>
            <input type="text" name="txt_direccion" id="txt_direccion" class="form-control"  placeholder="Ejemplo: #casa calle avenida"  required>

            <!-- Teléfono -->
            <label for="lbl_telefono" class="form-label"><b>Telefono</b></label>
            <input type="number" name="txt_telefono" id="txt_telefono" class="form-control"  placeholder="Ejemplo: 55551234"  required>

            <!-- Fecha de Nacimiento -->
            <label for="lbl_fn" class="form-label"><b>Nacimiento</b></label>
            <input type="date" name="txt_fn" id="txt_fn" class="form-control"  placeholder="Ejemplo: yyyy-MM-dd"  required>

            <!-- Puesto -->
            <br>
            <label for="lbl_fn" class="form-label"><b>Puesto</b></label>
            <select name="drop_puesto" id="drop_puesto" class="form-select" required>
                <option selected disabled value="">Seleccione</option>
                <?php 
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect ($db_host,$db_user,$db_pass,$db_dbName);
                    //$db_conexion -> real_query ("SELECT id, puesto FROM puestos;"); //Conexión phpMyAdmin
                    $db_conexion -> real_query ("SELECT id_puesto, puesto FROM puestos;");
                    $resultado = $db_conexion -> use_result();
                    //echo $resultado;
                    while($fila = $resultado -> fetch_assoc()){
                        echo "<option value=". $fila['id_puesto'] .">". $fila['puesto']."</option>";

                    }
                    $db_conexion ->close();
                ?>
            </select>

            </br>
            <button name="btn_crear" id="btn_crear" class="btn btn-primary"  value="crear" ><i class="bi bi-floppy-fill"></i> Crear</button>
            <button name="btn_actualizar" id="btn_actualizar" class="btn btn-warning"  value="actualizar" ><i class="bi bi-pencil-fill" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false"></i> Actualizar</button>
            <button name="btn_eliminar" id="btn_eliminar" class="btn btn-danger"  value="eliminar" ><i class="bi bi-trash-fill"></i> Eliminar</button>
            <button name="btn_nuevo" id="btn_nuevo" class="btn btn-info"  value="limpiar" onclick="limpiar()"><i class="bi bi-plus-square"></i> Limpiar</button>
        </form>

        <!-- Tabla de Empleados -->
        
        <br><h1>Lista de Empleados</h1>
        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                <th>Codigo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Puesto</th>
                <th>Nacimiento</th>
                </tr>
            </thead>
            <tbody id="tbl_empleados">
                <?php 
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_user,$db_pass,$db_dbName);
                    // $db_conexion -> real_query ("SELECT e.id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, p.puesto, e.fecha_nacimiento, p.id FROM empleados as e inner join puestos as p on e.id_puesto = p.id;"); // phpMyAdmin
                    $db_conexion -> real_query ("SELECT e.id_empleado, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, p.puesto, e.fecha_nacimiento, p.id_puesto FROM empleados as e inner join puestos as p on e.id_puesto = p.id_puesto;");
                    $resultado = $db_conexion -> use_result();
                    while ($fila = $resultado ->fetch_assoc()){
                    echo "<tr data-id=". $fila['id_empleado']." data-idp=". $fila['id_empleado'].">";
                    echo "<td>". $fila['codigo']."</td>";
                    echo "<td>". $fila['nombres']."</td>";
                    echo "<td>". $fila['apellidos']."</td>";
                    echo "<td>". $fila['direccion']."</td>";
                    echo "<td>". $fila['telefono']."</td>";
                    echo "<td>". $fila['puesto']."</td>";
                    echo "<td>". $fila['fecha_nacimiento']."</td>";
                    echo "</tr>";

                    }
                    $db_conexion ->close();
                ?>
            </tbody>
        </table>

    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>

    <!-- Jquery js -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function limpiar(){
            $("#txt_id").val(0);
            $("#txt_codigo").val('');
            $("#txt_nombres").val('');
            $("#txt_apellidos").val('');
            $("#txt_direccion").val('');
            $("#txt_telefono").val('');
            $("#txt_fn").val('');
            $("#drop_puesto").val(0);
            
        }
        $('#tbl_empleados').on('click','tr td',function(evt){
            var target, id, idp, codigo, nombres, apellidos, direccion, telefono, nacimiento;
            target = $(event.target);
            id = target.parent().data('id');
            idp = target.parent().data('idp');

            //Definimos el valor del campo en las variables correspondientes
            codigo = target.parent("tr").find("td").eq(0).html();
            nombres = target.parent("tr").find("td").eq(1).html();
            apellidos =  target.parent("tr").find("td").eq(2).html();
            direccion = target.parent("tr").find("td").eq(3).html();
            telefono = target.parent("tr").find("td").eq(4).html();
            nacimiento  = target.parent("tr").find("td").eq(6).html();


            //Definimos las variables y las usamos para llenar los campos en el formulario
            $("#txt_id").val(id);
            $("#txt_codigo").val(codigo);
            $("#txt_nombres").val(nombres);
            $("#txt_apellidos").val(apellidos);
            $("#txt_direccion").val(direccion);
            $("#txt_telefono").val(telefono);
            $("#txt_fn").val(nacimiento);
            $("#drop_puesto").val(idp);
            //$("#modal_empleados").modal('show');
            
        });
    </script>

</body>
</html>