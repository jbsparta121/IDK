<?php 
include("../../bd.php");

if(isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId']))?$_GET['txtId']:"";

    $sentencia = $conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen['imagen'])) {
        if(file_exists("../../../assets/img/team/".$registro_imagen['imagen'])) {
            unlink("../../../assets/img/team/".$registro_imagen['imagen']);
        } 
    }

    $sentencia = $conexion->prepare("DELETE FROM `tbl_equipo` WHERE id=:id;");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_equipo");
$sentencia->execute();
$lista_equipo = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); 
?>

<div class="card">
    <div class="card-header"><a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a></div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">Header</div>
            <div class="card-body">
                <div
                    class="table-responsive-sm"
                >
                    <table
                        class="table"
                    >
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Puesto</th>
                                <th scope="col">Redes sociales</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($lista_equipo as $registros) { ?>
                            <tr class="">
                                <td><?php echo $registros['id']; ?></td>
                                <td><img width="100" src="../../../assets/img/team/<?php echo $registros['imagen']; ?>" /></td>
                                <td><?php echo $registros['nombre']; ?></td>
                                <td><?php echo $registros['puesto']; ?></td>
                                <td>
                                    <?php echo $registros['twitter']; ?><br/>
                                    <?php echo $registros['facebook']; ?><br/>
                                    <?php echo $registros['linkedin']; ?><br/>
                                </td>
                                <td>
                                    <a name="" id="" class="btn btn-info" href="editar.php?txtId=<?php echo $registros['id']; ?>" role="button">Editar</a> 
                                    |
                                    <a name="" id="" class="btn btn-danger" href="index.php?txtId=<?php echo $registros['id']; ?>" role="button">Eliminar</a>    
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php") ?>