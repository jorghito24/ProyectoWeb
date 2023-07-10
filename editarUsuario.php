<?php
include_once "db_tienda.php";
$con = mysqli_connect($host, $user, $pass, $db);
if (isset($_REQUEST['guardar'])) {

    $email = mysqli_real_escape_string($con, $_REQUEST['email'] ?? '');
    $pass = md5(mysqli_real_escape_string($con, $_REQUEST['pass'] ?? ''));
    $nombre = mysqli_real_escape_string($con, $_REQUEST['nombre'] ?? '');
    $id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
    $query = "UPDATE usuarios SET
    email= '" . $email . "' ,pass= '" . $pass . "', nombre= '" . $nombre . "'
    where id='" . $id . "';
    ";
    $res = mysqli_query($con, $query);
    if ($res) {
        echo '<meta http-equiv="refresh" content="0 url=panel.php?modulo=usuarios&mensaje=Usuario ' . $nombre . ' editado exitosamente"/>';
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            Error al crear el usuario
            <?php echo mysqli_error($con); ?>
        </div>
        <?php
    }
}
$id = mysqli_real_escape_string($con, $_REQUEST['id'] ?? '');
$query = "SELECT id,email,pass,nombre from usuarios WHERE id='" . $id . "';";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Crear Usuarios</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="panel.php?modulo=editarUsuarios" method="post">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="" class="form-control"
                                        value="<?php echo $row['email'] ?>" placeholder="Email"
                                        required>

                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="pass" id="" class="form-control"
                                        placeholder="Contraseña" required>

                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" id="" class="form-control"
                                        value="<?php echo $row['nombre'] ?>" placeholder="Nombre"
                                        required>

                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-primary" name="guardar">Guardar</button>
                                </div>

                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>