<?php 
include("../../bd.php");
if($_POST) {
    $imagen = (isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $nombre = (isset($_POST['nombre']))?$_POST['nombre']:"";
    $puesto = (isset($_POST['puesto']))?$_POST['puesto']:"";
    $twitter = (isset($_POST['twitter']))?$_POST['twitter']:"";
    $facebook = (isset($_POST['facebook']))?$_POST['facebook']:"";
    $linkedin = (isset($_POST['linkedin']))?$_POST['linkedin']:"";

    $fecha_imagen = new DateTime();
    $nombre_archivo_imagen = ($imagen!="")?$fecha_imagen->getTimestamp()."_".$imagen:"";
    $tmp_imagen = $_FILES['imagen']['tmp_name'];
    if($tmp_imagen!="") {
        move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    }

    $sentencia = $conexion->prepare("INSERT INTO `tbl_equipo` 
        (`id`, `imagen`, `nombre`, `puesto`,  `twitter`, `facebook`, `linkedin`) 
        VALUES (NULL, :imagen, :nombre, :puesto, :twitter, :facebook, :linkedin);");
    
    $sentencia->bindParam(":imagen",$nombre_archivo_imagen);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":puesto",$puesto);
    $sentencia->bindParam(":twitter",$twitter);
    $sentencia->bindParam(":facebook",$facebook);
    $sentencia->bindParam(":linkedin",$linkedin);
    $sentencia->execute();

    $mensaje = "Registro agregado con éxito.";
    header("Location:index.php?mensaje=".$mensaje);
}


include("../../templates/header.php"); 

?>

<div class="card">
    <div class="card-header">Datos de la persona</div>
    <div class="card-body">

    <form action="" method="post" enctype="multipart/form-data">
        
        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen:</label>
            <input
                type="file"
                class="form-control"
                name="imagen"
                id="imagen"
                placeholder="Imagen"
                aria-describedby="fileHelpId"
            />            
        </div>
        
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre Completo:</label>
            <input
                type="text"
                class="form-control"
                name="nombre"
                id="nombre"
                aria-describedby="helpId"
                placeholder="Nombre Completo"
            />
        </div>

        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <input
                type="text"
                class="form-control"
                name="puesto"
                id="puesto"
                aria-describedby="helpId"
                placeholder="Puesto"
            />
        </div>

        <div class="mb-3">
            <label for="twitter" class="form-label">Twitter:</label>
            <input
                type="text"
                class="form-control"
                name="twitter"
                id="twitter"
                aria-describedby="helpId"
                placeholder="Twitter"
            />
        </div>
        
        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook:</label>
            <input
                type="text"
                class="form-control"
                name="facebook"
                id="facebook"
                aria-describedby="helpId"
                placeholder="Facebook"
            />
        </div>
        
        <div class="mb-3">
            <label for="linkedin" class="form-label">Linkedin:</label>
            <input
                type="text"
                class="form-control"
                name="linkedin"
                id="linkedin"
                aria-describedby="helpId"
                placeholder="Linkedin"
            />
        </div>
        
        <button
            type="submit"
            class="btn btn-success"
            >
            Agregar
        </button>
                
        <a
            name=""
            id=""
            class="btn btn-primary"
            href="index.php"
            role="button"
            >Cancelar</a
        >

    </form>
        
        
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("../../templates/footer.php") ?>