<?php 
include("../../bd.php");

if(isset($_GET['txtId'])) {
    $txtId = (isset($_GET['txtId']))?$_GET['txtId']:"";

    $sentencia = $conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen['imagen'])) {
        if(file_exists("../../../assets/img/about/".$registro_imagen['imagen'])) {
            unlink("../../../assets/img/about/".$registro_imagen['imagen']);
        } 
    }

    $sentencia = $conexion->prepare("DELETE FROM `tbl_entradas` WHERE id=:id;");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_entradas");
$sentencia->execute();
$lista_entradas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php"); 
?>

<div class="card">
<div class="card-header"> <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registro</a></div>
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
                        <th scope="col">Fecha</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_entradas as $registros) { ?>
                    <tr class="">
                        <td><?php echo $registros['id']; ?></td>
                        <td><?php echo $registros['fecha']; ?></td>
                        <td><?php echo $registros['titulo']; ?></td>
                        <td><?php echo $registros['descripcion']; ?></td>
                        <td><img width="100" src="../../../assets/img/about/<?php echo $registros['imagen']; ?>" /></td>
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
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php") ?>